<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificar".
 *
 * @property integer $idnotificar
 * @property integer $fkcontacto
 * @property integer $fkcontacto_notificar
 *
 * @property Contacto $fkcontacto0
 * @property Contacto $fkcontactoNotificar
 */
class Notificar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkcontacto', 'fkcontacto_notificar'], 'required'],
            [['fkcontacto', 'fkcontacto_notificar'], 'integer'],
            [['fkcontacto'], 'exist', 'skipOnError' => true, 'targetClass' => Contacto::className(), 'targetAttribute' => ['fkcontacto' => 'idcontacto']],
            [['fkcontacto_notificar'], 'exist', 'skipOnError' => true, 'targetClass' => Contacto::className(), 'targetAttribute' => ['fkcontacto_notificar' => 'idcontacto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnotificar' => 'Idnotificar',
            'fkcontacto' => 'Fkcontacto',
            'fkcontacto_notificar.' => 'Fkcontacto Notificar',
            'fkcontactoNotificar.nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkcontacto0()
    {
        return $this->hasOne(Contacto::className(), ['idcontacto' => 'fkcontacto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkcontactoNotificar()
    {
        return $this->hasOne(Contacto::className(), ['idcontacto' => 'fkcontacto_notificar']);
    }


}
