<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mce_uso_marca".
 *
 * @property integer $umar_id
 * @property string $umar_nombre
 * @property string $umar_fecha_creacion
 * @property string $umar_fecha_modificacion
 * @property integer $umar_estado_logico
 *
 * @property MceUsoMarcaFormulario[] $mceUsoMarcaFormularios
 * @property MceUsoMarcaFormularioTemp[] $mceUsoMarcaFormularioTemps
 */
class MceUsoMarca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mce_uso_marca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['umar_nombre', 'umar_estado_logico'], 'required'],
            [['umar_fecha_creacion', 'umar_fecha_modificacion'], 'safe'],
            [['umar_estado_logico'], 'integer'],
            [['umar_nombre'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'umar_id' => Yii::t('mce_uso_marca', 'Umar ID'),
            'umar_nombre' => Yii::t('mce_uso_marca', 'Umar Nombre'),
            'umar_fecha_creacion' => Yii::t('mce_uso_marca', 'Umar Fecha Creacion'),
            'umar_fecha_modificacion' => Yii::t('mce_uso_marca', 'Umar Fecha Modificacion'),
            'umar_estado_logico' => Yii::t('mce_uso_marca', 'Umar Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceUsoMarcaFormularios()
    {
        return $this->hasMany(MceUsoMarcaFormulario::className(), ['umar_id' => 'umar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceUsoMarcaFormularioTemps()
    {
        return $this->hasMany(MceUsoMarcaFormularioTemp::className(), ['umar_id' => 'umar_id']);
    }
    
    public static function getUsoMarca(){
        $sql="SELECT umar_id,umar_nombre,umar_detalle FROM mce_base.mce_uso_marca  where umar_estado_logico=1;";
        $comando = Yii::$app->db->createCommand($sql);
        return $comando->queryAll();
    }
    
    public static function getUsoMarcaDetalle($umar_id){
        $sql="SELECT umar_id,umar_nombre,umar_detalle FROM mce_base.mce_uso_marca  where umar_estado_logico=1 and umar_id=:umar_id;";
        $comando = Yii::$app->db->createCommand($sql);
        $comando->bindParam(":umar_id", $umar_id, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
}
