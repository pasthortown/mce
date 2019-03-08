<?php
namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Utilities;
use yii\helpers\Json;

class ApiController extends ActiveController {

    public $modelClass = '';

    private $contentType = array("html" => "text/html", "json" => "application/json", "xml" => "application/xml");

    /**
     * @return array action filters
     */
    public function filters() {
        return array();
    }
    
    public function checkAccess($action, $model = null, $params = [])
    {
        return parent::checkAccess($action, $model, $params);
    }
    
    public function actionRequest($modelo, $metodo, $format) {     
        $format = isset($format) ? strtolower($format) : "json";
        $this->_checkAuth($format);
        $modelName = $model = $modelo . "_" . "ApiRest";
        $model = str_replace("{MODEL}", $modelName, "\app\models\{MODEL}");
        if (!class_exists($model)) {
            $this->_sendResponse(404, "", 'bad request', $format);
        }
        $vclass = new $model($this->_getParameters());
        if (!method_exists($vclass, $metodo)) {
            $this->_sendResponse(404, '', 'bad request', $format);
        }
        $result = $vclass->$metodo();
        if (!is_array($result) || $result == FALSE)
            $this->_sendResponse(200, Yii::t("notificaciones_rest", 'No items where found for {model}.', array("model" => $modelo)), 'bad request', $format);
        else
            $this->_sendResponse(200, $result, 'return', $format);
    }

    public function actionList($modelo, $format) {
        $format = isset($format) ? strtolower($format) : "json";
        $this->_checkAuth($format);
        $modelName = $model = $modelo . "_" . "ApiRest";
        $model = str_replace("{MODEL}", $modelName, "\app\models\{MODEL}");
        if (!class_exists($model)) {
            $this->_sendResponse(404, '', 'bad request', $format);
        }
        $result = $model::model()->findAll();
        if (empty($result)) {
            $this->_sendResponse(200, Yii::t("notificaciones_rest", 'No items where found for {model}.', array("model" => $modelo)), 'bad request', $format);
        } else {
            $rows = array();
            foreach ($result as $item)
                $rows[] = $item->attributes;
            $this->_sendResponse(200, $rows, "return", $format);
        }
    }

    public function actionView($modelo, $id, $format) {
        $format = isset($format) ? strtolower($format) : "json";
        $this->_checkAuth($format);
        $modelName = $model = $modelo . "_" . "ApiRest";
        $model = str_replace("{MODEL}", $modelName, "\app\models\{MODEL}");
        if (!class_exists($model)) {
            $this->_sendResponse(404, '', 'bad request', $format);
        }
        if (!isset($id))
            $this->_sendResponse(500, Yii::t("notificaciones_rest", 'Parameter id is missing.'), 'bad request', $format);

        $result = $model::model()->findByPk($id);
        // Did we find the requested model? If not, raise an error
        if (is_null($result))
            $this->_sendResponse(404, Yii::t("notificaciones_rest", 'No Item found with id = {id}.', array("id" => $id)), "bad request", $format);
        else
            $this->_sendResponse(200, $result, 'return', $format);
    }

    public function actionCreate($modelo, $format) {
        $format = isset($format) ? strtolower($format) : "json";
        $this->_checkAuth($format);
        $modelName = $model = $modelo . "_" . "ApiRest";
        $model = str_replace("{MODEL}", $modelName, "\app\models\{MODEL}");
        if (!class_exists($model)) {
            $this->_sendResponse(404, '', 'bad request', $format);
        }
        $vclass = new $model();
        // Try to assign POST values to attributes
        $params = $this->_getParameters();
        foreach ($params as $var => $value) {
            // Does the model have this attribute? If not raise an error
            if ($vclass->hasAttribute($var))
                $vclass->$var = $value;
            else
                $this->_sendResponse(500, Yii::t("notificaciones_rest", "Parameter {param} is not allowed for {model}.", array("param" => $var, "model" => $modelo)), "bad request", $format);
        }
        // Try to save the model
        if ($vclass->save())
            $this->_sendResponse(200, $vclass, 'return', $format);
        else {
            $this->_sendResponse(500, Yii::t("notificaciones_rest", "Could not create {model}.", array("model" => $modelo)), 'bad request', $format);
        }
    }

    public function actionUpdate($modelo, $id, $format) {
        $format = isset($format) ? strtolower($format) : "json";
        $this->_checkAuth($format);
        $modelName = $model = $modelo . "_" . "ApiRest";
        $model = str_replace("{MODEL}", $modelName, "\app\models\{MODEL}");
        if (!class_exists($model)) {
            $this->_sendResponse(404, '', 'bad request', $format);
        }
        // Parse the PUT parameters. This didn't work: parse_str(file_get_contents('php://input'), $put_vars);
        $json = file_get_contents('php://input'); //$GLOBALS['HTTP_RAW_POST_DATA'] is not preferred: http://www.php.net/manual/en/ini.core.php#ini.always-populate-raw-post-data
        $put_vars = CJSON::decode($json, true);  //true means use associative array
        $vclass = $model::model()->findByPk($id);
        if ($vclass === null)
            $this->_sendResponse(400, Yii::t("notificaciones_rest", "Did not find any {model} with id = {id}.", array("model" => $modelo, "id" => $id)), 'bad request', $format);

        // Try to assign PUT parameters to attributes
        foreach ($put_vars as $var => $value) {
            // Does model have this attribute? If not, raise an error
            if ($vclass->hasAttribute($var))
                $vclass->$var = $value;
            else {
                $this->_sendResponse(500, Yii::t("notificaciones_rest", "Parameter {param} is not allowed for {model}.", array("param" => $var, "model" => $modelo)), "bad request", $format);
            }
        }
        // Try to save the model
        if ($vclass->save())
            $this->_sendResponse(200, $vclass, "return", $format);
        else
            $this->_sendResponse(500, Yii::t("notificaciones_rest", "Could not create {model}.", array("model" => $modelo)), 'bad request', $format);
    }

    public function actionDelete($modelo, $id, $format) {
        $format = isset($format) ? strtolower($format) : "json";
        $this->_checkAuth($format);
        $modelName = $model = $modelo . "_" . "ApiRest";
        $model = str_replace("{MODEL}", $modelName, "\app\models\{MODEL}");
        if (!class_exists($model)) {
            $this->_sendResponse(404, '', 'bad request', $format);
        }
        $vclass = $model::model()->findByPk($id);
        // Was a model found? If not, raise an error
        if ($vclass === null)
            $this->_sendResponse(400, Yii::t("notificaciones_rest", "Did not find any {model} with id = {id}.", array("model" => $modelo, "id" => $id)), 'bad request', $format);

        // Delete the model
        $num = $vclass->delete();
        if ($num > 0)
            $this->_sendResponse(200, array("estado" => $num), 'return', $format);
        else
            $this->_sendResponse(500, Yii::t("notificaciones_rest", "Could not delete {model} with id = {id}.", array("model" => $modelo, "id" => $id)), 'bad request', $format);
    }

    protected function beforeSave() {
        
    }

    private function _sendResponse($status = 200, $body = '', $action = '', $format = 'html') {
        // set the status
        $content_type = $this->contentType[$format];
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type . '; charset=utf-8'); // application/x-www-form-urlencoded 
        $message = $body;
        $label = 'success';
        $error = 'false';
        switch ($status) {
            case 400:
                $message = ($body == "") ? Yii::t("jslang", "Bad Request") : $body;
                $label = "error";
                $error = 'true';
                break;
            case 401:
                $message = ($body == "") ? Yii::t("jslang", "You must be authorized to view this page") : $body;
                $label = "error";
                $error = 'true';
                break;
            case 404:
                $message = ($body == "") ? Yii::t("jslang", "Page not found") : $body;
                $label = "error";
                $error = 'true';
                break;
            case 500:
                $message = ($body == "") ? Yii::t("jslang", "The server encountered an error processing your request") : $body;
                $label = "error";
                $error = 'true';
                break;
            case 501:
                $message = ($body == "") ? Yii::t("jslang", "The requested method is not implemented") : $body;
                $label = "error";
                $error = 'true';
                break;
            case 1000:
                $message = ($body == "") ? Yii::t("jslang", "You must be authorized to view this page") : $body;
                $label = "error";
                $error = 'true';
                break;
            case 1001:
                $message = ($body == "") ? Yii::t("jslang", "You must be authorized to view this page") : $body;
                $label = "error";
                $error = 'true';
                break;
        }
        if ($body == '') {
            // servers don't always have a signature turned on 
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
            // <address>' . $signature . '</address>
            // this should be templated in a real-world solution
            $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                    <html>
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                    </head>
                    <body>
                    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                    <p>' . $message . '</p>
                    <hr />
                    <address>' . $signature . '</address>
                    <br /> 
                    </body>
                    </html>
                    ';
        }
        $body2 = array('state' => $status, "type" => "", "label" => $label, "error" => $error, "message" => $message, "action" => $action);
        switch ($format) {
            case "html":
                if (is_array($body))
                    Utilities::xml_encode($body);
                else
                    echo $body;
                break;
            case "xml":
                Utilities::xml_encode($body2);
                break;
            case "json":
                echo Json::encode($body2);
                //echo utf8_encode(Json::encode($body2));
                break;
            default:
                echo Json::encode($body2);
                //echo utf8_encode(Json::encode($body2));
                break;
        }
        Yii::$app->end();
    }

    private function _getStatusCodeMessage($status) {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => Yii::t("jslang", 'OK'),
            400 => Yii::t("jslang", 'Bad Request'),
            401 => Yii::t("jslang", 'You must be authorized to view this page'),
            402 => Yii::t("jslang", 'Payment required'),
            403 => Yii::t("jslang", 'Forbidden'),
            404 => Yii::t("jslang", 'Page not found'),
            500 => Yii::t("jslang", 'The server encountered an error processing your request'),
            501 => Yii::t("jslang", 'The requested method is not implemented'),
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    private function _getParameters() {
        $data = array_merge($_GET, $_POST);
        $params = array();
        foreach ($data as $key => $value) {
            $clave = strtolower($key);
            if ($clave != "ip" && $clave != "mac" && $clave != "so" && $clave != "device" && $clave != "model" && $clave != "version" && $clave != "action" && $clave != "numberSecret" && $clave != "format") // && $clave != "deviceid" && $clave != "tokenid")
                $params[$clave] = $value;
        }
        return $params;
    }

    private function _checkAuth($format) {
        $format = isset($format) ? strtolower($format) : "json";
        $data = array_merge($_GET, $_POST);
        if (count($data) <= 0 && !isset($data)) {
            $this->_sendResponse(400, '', '', $format);
        }
        $tokenid = (isset($data['tokenid'])) ? $data['tokenid'] : null;
        $numberSecret = (isset($data['numbersecret'])) ? $data['numbersecret'] : null;
        
        $session = Yii::$app->session;
        if ($session->get('PB_isuser')){
            return true;
        }
        // se debe recibir el token
        if (Utilities::validateToken($tokenid, $numberSecret)) {
            return true;
        }
        $this->_sendResponse(400, 'Device not allowed', 'reconnect', $format);
    }

}
