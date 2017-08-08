<?php

namespace common\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "contacto".
 *
 * @property integer $idcontacto
 * @property string $nombre
 * @property string $telefono
 * @property string $movil
 * @property string $correo
 * @property integer $fkuser
 * @property boolean $st_actual
 * @property integer $fkempresa
 * @property string $Created_by
 * @property string $Updated_By
 * @property string $Created_At
 * @property string $Updated_At
 *
 * @property Empresa $fkempresa0
 * @property User $fkuser0
 */
class Contacto extends \yii\db\ActiveRecord
{
    public $st_estatus;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcontacto', 'nombre', 'fkempresa', /* 'Created_by', 'Created_At' */], 'required'],
            [['idcontacto', 'fkuser', 'fkempresa'], 'integer'],
            [['st_actual', 'st_estatus'], 'boolean'],
            [['Created_At', 'Updated_At'], 'safe'],
            [['nombre', 'telefono', 'movil', 'correo'], 'string', 'max' => 45],
            [['Created_by', 'Updated_By'], 'string', 'max' => 30],
            [['fkempresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['fkempresa' => 'idempresa']],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fkuser' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcontacto' => 'Idcontacto',
            'nombre' => 'Nombre',
            'telefono' => 'Telefono',
            'movil' => 'Movil',
            'correo' => 'Correo',
            'fkuser' => 'Usuario',
            'st_actual' => 'Actual',
            'fkempresa' => 'Empresa',
            'fkuser0.username' => 'Username',
            'fkempresa0.nombre' => 'Empresa',
            'st_estatus' => 'Notificar'
        ];
    }

    public function getFkEmpresa($id = 0)
    {
        $query = Yii::$app->db->createCommand('SELECT fkempresa FROM contacto  WHERE fkuser =' .$id)
           ->queryOne();

        return $query['fkempresa'];        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkempresa0()
    {
        return $this->hasOne(Empresa::className(), ['idempresa' => 'fkempresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkuser0()
    {
        return $this->hasOne(User::className(), ['id' => 'fkuser']);
    }
}
