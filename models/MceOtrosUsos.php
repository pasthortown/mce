<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mce_otros_usos".
 *
 * @property integer $ous_id
 * @property string $ous_nombre
 * @property string $ous_fecha_creacion
 * @property string $ous_fecha_modificacion
 * @property integer $ous_estado_logico
 *
 * @property MceOtrosUsosMarca[] $mceOtrosUsosMarcas
 * @property MceOtrosUsosMarcaTemp[] $mceOtrosUsosMarcaTemps
 */
class MceOtrosUsos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mce_otros_usos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ous_nombre', 'ous_estado_logico'], 'required'],
            [['ous_fecha_creacion', 'ous_fecha_modificacion'], 'safe'],
            [['ous_estado_logico'], 'integer'],
            [['ous_nombre'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ous_id' => Yii::t('mce_otros_usos', 'Ous ID'),
            'ous_nombre' => Yii::t('mce_otros_usos', 'Ous Nombre'),
            'ous_fecha_creacion' => Yii::t('mce_otros_usos', 'Ous Fecha Creacion'),
            'ous_fecha_modificacion' => Yii::t('mce_otros_usos', 'Ous Fecha Modificacion'),
            'ous_estado_logico' => Yii::t('mce_otros_usos', 'Ous Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceOtrosUsosMarcas()
    {
        return $this->hasMany(MceOtrosUsosMarca::className(), ['ous_id' => 'ous_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceOtrosUsosMarcaTemps()
    {
        return $this->hasMany(MceOtrosUsosMarcaTemp::className(), ['ous_id' => 'ous_id']);
    }
    
    public static function getOtrosUsoMarca(){
        $sql="SELECT ous_id,ous_nombre FROM mce_otros_usos where ous_estado_logico=1;";
        $comando = Yii::$app->db->createCommand($sql);
        return $comando->queryAll();
    }
    
    public static function getPorcentaje(){
        $sql="SELECT por_id,por_nombre FROM mce_base.mce_porcentaje where por_estado_logico=1;";
        $comando = Yii::$app->db->createCommand($sql);
        return $comando->queryAll();
    }
    
}
