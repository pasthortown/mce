<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user = false;
    private $_errorSession = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            [['username'], 'trim'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('login', 'Email'),
            'password' => Yii::t('login', 'Password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t("login",'Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {   
        if ($this->validate()) {
            $usuario = Usuario::findByUsername($this->username);
            if(isset($usuario)){
                $status = $usuario->validatePassword($this->password);
                $status_activo = $usuario->usu_estado_activo;
                $status_logico = $usuario->usu_estado_logico;
                $status_link = $usuario->usu_link_activo;
                if($status_activo == 1 && ($status_link == "" || is_null($status_link)) && $status_logico == 1){ // si es usuario activo
                    if($status && isset($status)){
                        //$usuario->init();
                        $usuario->createSession();
                        $usuario->usu_last_login = date("Y-m-d H:i:s");
                        $usuario->update(true, array("usu_last_login"));
                        Yii::$app->user->login($usuario, 0);
                        Yii::$app->user->setIdentity($usuario);
                    }elseif ($status_logico == 0) { // account removed
                        $this->setErrorSession(true);
                        Yii::$app->session->setFlash('error',Yii::t("login","<h4>Error</h4>Invalid Account."));
                        $usuario->destroySession();
                        return false;
                    }else { // error password
                        $this->setErrorSession(true);
                        Yii::$app->session->setFlash('error',Yii::t("login","<h4>Error</h4>Incorrect username or password."));
                        $usuario->destroySession();
                        return false;
                    }
                }else{ // account disabled
                    $this->setErrorSession(true);
                    Yii::$app->session->setFlash('error',Yii::t("login","<h4>Error</h4>Account is disabled. Please confirm the account with link activation in your email account or reset your password."));
                    $usuario->destroySession();
                    return false;
                }
                return $status;
            }else{
                $this->setErrorSession(true);
                Yii::$app->session->setFlash('error',Yii::t("login","<h4>Error</h4>Invalid Account. Account can be disabled please please confirm the account with link activation in your email account or reset your password."));
                return false;
            }
        } else {
            $this->setErrorSession(true);
            Yii::$app->session->setFlash('error',Yii::t("login","<h4>Error</h4>Incorrect username or password."));
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::findByUsername($this->username);
        }
        return $this->_user;
    }
    
    public function getErrorSession() {
        return $this->_errorSession;
    }
    
    public function setErrorSession($error){
        $this->_errorSession = $error;
    }
}
