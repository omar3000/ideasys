<?php

namespace common\models;
use Yii;
use yii\db\Query;
use common\models\User;


/**
 * This is the model class for table "servicio".
 *
 * @property integer $idservicio
 * @property integer $fkuser_solicitante
 * @property integer $fkuser_atendio
 * @property integer $fkusuario_atendio2
 * @property string $fecha_hr_solicitada
 * @property string $fecha_hr_inicio
 * @property string $fecha_hr_fin
 * @property string $autorizo
 * @property string $Created_by
 * @property string $Updated_By
 * @property string $Created_At
 * @property string $Updated_At
 * @property string $problema
 * @property string $razon0
 * @property string $solucion
 * @property string $estatus
 * @property boolean $principal 
 * 
 * @property User $fkuserSolicitante
 * @property User $fkuserAtendio
 * @property User $fkusuarioAtendio2
 */
class Servicio extends \yii\db\ActiveRecord
{
     const CREADO = 1;
     const INICIADO = 2;
     const FINALIZADO = 3;

     Const COSTO_NORMAL =1800.00;
     Const COSTO_EXTRA =3600.00;


     public $principal,$stcosto0,$solicitante; 


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkuser_solicitante', 'problema', 'estatus', 'autorizo', 'fecha_hr_solicitada'], 'required' ],
            [['fkuser_solicitante', 'fkuser_atendio', 'fkusuario_atendio2', 'estatus'], 'integer'],
            [['fecha_hr_solicitada', 'fecha_hr_inicio', 'fecha_hr_fin', 'Created_At', 'Updated_At'], 'safe'],
            [['autorizo'], 'string', 'max' => 45],
            [['principal','stcosto0'], 'boolean'],
            [['problema', 'solucion', 'razon0'], 'string', 'max' => 255],
            [['Created_by', 'Updated_By'], 'string', 'max' => 30],
            [['fkuser_solicitante'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fkuser_solicitante' => 'id']],
            [['fkuser_atendio'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fkuser_atendio' => 'id']],
            [['fkusuario_atendio2'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fkusuario_atendio2' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idservicio' => '#servicio',
            'fkuser_solicitante' => 'Usuario Solicitante',
            'fkuser_atendio' => 'Usuario que Atendio',
            'fkusuario_atendio2' => 'Usuario que Atendio 2',
            'fkuserSolicitante.username' => 'Usuario Solicitante',
            'Sestatus' => 'estatus',
            "Empresa" => 'empresa',
            'fecha_hr_solicitada' => 'Fecha del servicio solicitado',
            'fecha_hr_inicio' => 'Fecha de inicio servicio',
            'fecha_hr_fin' => 'Fecha fin del servicio',
            'autorizo' => 'Quien Autorizo?',
            'problema' => 'Problema',
            'solucion' => 'Solucion',
            'stcosto0' => 'Costo 0:',
            'razon0' => 'Razon costo 0', 
            'estatus' => 'Estatus',
            'fkusuarioAtendio2.username' => 'Usuario secundario que atendio',
            'fkuserAtendio.username' => 'Usuario principal que atendio',
            'Created_by' => 'Created By',
            'Updated_By' => 'Updated  By',
            'Created_At' => 'Created  At',
            'Updated_At' => 'Updated  At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkuserSolicitante()
    {
        return $this->hasOne(User::className(), ['id' => 'fkuser_solicitante']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkuserAtendio()
    {
        return $this->hasOne(User::className(), ['id' => 'fkuser_atendio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkusuarioAtendio2()
    {
        return $this->hasOne(User::className(), ['id' => 'fkusuario_atendio2']);
    }

    public function getSestatus(){
        switch($this->estatus){
            case $this::CREADO:
                return "CREADO";
                break;
            case $this::INICIADO:
                return "INICIADO";
                break;
            case $this::FINALIZADO:
                return "FINALIZADO";
                break;
        }
    }

    public function getEmpresa($id = 0)
    {

        $query = Yii::$app->db->createCommand('SELECT e.nombre FROM empresa e INNER JOIN contacto c ON c.fkuser =' .$id  .' WHERE e.idempresa = c.fkempresa')
           ->queryOne();

        return $query['nombre'];        
    }
    /*
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['fkservicio' => 'idservicio']);
    }
    */
}
