<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mce_visita".
 *
 * @property integer $visi_id
 * @property integer $form_id
 * @property string $visi_observacion
 * @property string $visi_entrevistado
 * @property string $visi_telefono
 * @property string $visi_foto1
 * @property string $visi_foto2
 * @property string $visi_foto3
 * @property string $visi_foto4
 * @property string $visi_foto5
 * @property string $visi_fecha_visita
 * @property string $visi_fecha_creacion
 * @property string $visi_fecha_modificacion
 * @property integer $visi_estado_logico
 *
 * @property MceFormulario $form
 */
class MceVisita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mce_visita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id', 'visi_estado_logico'], 'required'],
            [['form_id', 'visi_estado_logico'], 'integer'],
            [['visi_observacion'], 'string'],
            [['visi_fecha_visita', 'visi_fecha_creacion', 'visi_fecha_modificacion'], 'safe'],
            [['visi_entrevistado', 'visi_telefono'], 'string', 'max' => 80],
            [['visi_foto1', 'visi_foto2', 'visi_foto3', 'visi_foto4', 'visi_foto5'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'visi_id' => Yii::t('mce_visita', 'Visi ID'),
            'form_id' => Yii::t('mce_visita', 'Form ID'),
            'visi_observacion' => Yii::t('mce_visita', 'Visi Observacion'),
            'visi_entrevistado' => Yii::t('mce_visita', 'Visi Entrevistado'),
            'visi_telefono' => Yii::t('mce_visita', 'Visi Telefono'),
            'visi_foto1' => Yii::t('mce_visita', 'Visi Foto1'),
            'visi_foto2' => Yii::t('mce_visita', 'Visi Foto2'),
            'visi_foto3' => Yii::t('mce_visita', 'Visi Foto3'),
            'visi_foto4' => Yii::t('mce_visita', 'Visi Foto4'),
            'visi_foto5' => Yii::t('mce_visita', 'Visi Foto5'),
            'visi_fecha_visita' => Yii::t('mce_visita', 'Visi Fecha Visita'),
            'visi_fecha_creacion' => Yii::t('mce_visita', 'Visi Fecha Creacion'),
            'visi_fecha_modificacion' => Yii::t('mce_visita', 'Visi Fecha Modificacion'),
            'visi_estado_logico' => Yii::t('mce_visita', 'Visi Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(MceFormulario::className(), ['form_id' => 'form_id']);
    }
}
