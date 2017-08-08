<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $idempresa
 * @property string $nombre
 * @property string $Created_by
 * @property string $Updated_By
 * @property string $Created_At
 * @property string $Updated_At
 *
 * @property Contacto[] $contactos
 */
class Empresa extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['Created_At','Updated_At'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
            [['Created_by', 'Updated_By'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idempresa' => 'Idempresa',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactos()
    {
        return $this->hasMany(Contacto::className(), ['fkempresa' => 'idempresa']);
    }

    public function getEmpresas()
    {
        $langValues = (new \yii\db\Query())
            ->select('e.idempresa AS id, e.nombre')
            ->from('empresa e ')
            ->all();

        return \yii\helpers\ArrayHelper::map($langValues,'id','nombre');
    }
}
