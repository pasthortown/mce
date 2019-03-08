<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mce_objetivo".
 *
 * @property integer $obj_id
 * @property string $obj_nombre
 * @property string $obj_fecha_creacion
 * @property string $obj_fecha_modificacion
 * @property integer $obj_estado_logico
 *
 * @property MceFormularioObjetivo[] $mceFormularioObjetivos
 * @property MceFormularioObjetivoTemp[] $mceFormularioObjetivoTemps
 */
class MceObjetivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mce_objetivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['obj_nombre', 'obj_estado_logico'], 'required'],
            [['obj_fecha_creacion', 'obj_fecha_modificacion'], 'safe'],
            [['obj_estado_logico'], 'integer'],
            [['obj_nombre'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'obj_id' => Yii::t('mce_objetivo', 'Obj ID'),
            'obj_nombre' => Yii::t('mce_objetivo', 'Obj Nombre'),
            'obj_fecha_creacion' => Yii::t('mce_objetivo', 'Obj Fecha Creacion'),
            'obj_fecha_modificacion' => Yii::t('mce_objetivo', 'Obj Fecha Modificacion'),
            'obj_estado_logico' => Yii::t('mce_objetivo', 'Obj Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceFormularioObjetivos()
    {
        return $this->hasMany(MceFormularioObjetivo::className(), ['obj_id' => 'obj_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceFormularioObjetivoTemps()
    {
        return $this->hasMany(MceFormularioObjetivoTemp::className(), ['obj_id' => 'obj_id']);
    }
    
    public static function getSubObjetivosID($ids){
        $sql = "SELECT sobj_id AS id,sobj_nombre AS name FROM mce_sub_objetivo WHERE obj_id=:obj_id AND sobj_estado_logico=1;";
        $comando = Yii::$app->db->createCommand($sql);
        $comando->bindParam(":obj_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public static function getSubObjetivoandObjetivoID($ids){
        $con = \Yii::$app->db;
        $sql="SELECT A.sobj_id,A.sobj_nombre,A.obj_id,B.obj_nombre
                FROM " . $con->dbname . ".mce_sub_objetivo A
                  INNER JOIN " . $con->dbname . ".mce_objetivo B
                    ON A.obj_id=B.obj_id
              WHERE A.sobj_estado_logico=1 AND A.sobj_id=:sobj_id ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":sobj_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public static function getObjetivoID($ids){
        $con = \Yii::$app->db;
        $sql="SELECT A.obj_id,A.obj_nombre
                FROM " . $con->dbname . ".mce_objetivo A
              WHERE A.obj_estado_logico=1 AND A.obj_id=:obj_id ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":obj_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    
}
