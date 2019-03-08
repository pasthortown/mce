<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mce_mensajes".
 *
 * @property integer $mens_id
 * @property integer $form_id
 * @property string $mens_mensaje
 * @property string $mens_fecha_creacion
 * @property string $mens_fecha_modificacion
 * @property integer $mens_estado_logico
 *
 * @property MceFormulario $form
 */
class MceMensajes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mce_mensajes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id', 'mens_estado_logico'], 'required'],
            [['form_id', 'mens_estado_logico'], 'integer'],
            [['mens_mensaje'], 'string'],
            [['mens_fecha_creacion', 'mens_fecha_modificacion'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mens_id' => Yii::t('mce_mensajes', 'Mens ID'),
            'form_id' => Yii::t('mce_mensajes', 'Form ID'),
            'mens_mensaje' => Yii::t('mce_mensajes', 'Mens Mensaje'),
            'mens_fecha_creacion' => Yii::t('mce_mensajes', 'Mens Fecha Creacion'),
            'mens_fecha_modificacion' => Yii::t('mce_mensajes', 'Mens Fecha Modificacion'),
            'mens_estado_logico' => Yii::t('mce_mensajes', 'Mens Estado Logico'),
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
