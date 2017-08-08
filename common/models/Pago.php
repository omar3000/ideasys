<?php

namespace common\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property integer $idpago
 * @property integer $fkservicio
 * @property integer $fkempresa
 * @property double $costo
 * @property integer $estatus
 * @property string $descripcion
 * @property string $observacion
 * @property double $pagoConfirmado
 * @property double $pagoPendiente
 * @property double $st_actual
 * @property string $Created_by
 * @property string $Updated_By
 * @property string $Created_At
 * @property string $Updated_At
 *
 * @property Servicio $fkservicio0
 * @property Servicio $fkempresa0
 */
class Pago extends \yii\db\ActiveRecord
{
    const PENDIENTE = 0;
    const VERIFICAR = 1;
    const PAGADO = 2;



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkempresa'], 'required' ],
            [['fkservicio', 'fkempresa', 'estatus'], 'integer'],
            [['costo', 'pagoPendiente', 'pagoConfirmado'], 'number'],
            [['st_actual'], 'boolean'],
            [['Created_At', 'Updated_At'], 'safe'],
            [['Created_by', 'Updated_By'], 'string', 'max' => 30],
            [['descripcion', 'observacion'], 'string', 'max' => 255],
            [['fkservicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicio::className(), 'targetAttribute' => ['fkservicio' => 'idservicio']],
            [['fkempresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['fkempresa' => 'idempresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpago' => '#Pago',
            'descripcion' => 'Descripcion',
            'observacion' => 'Observacion', 
            'costo' => 'Costo',
            'estatus' => 'Estatus',
            'fkempresa' => 'Empresa',
            'fkservicio' => '#servicio'

        ];
    }

    public function getSestatus()
    {
        switch($this->estatus){
            case $this::PENDIENTE:
                return "PENDIENTE";
                break;
            case $this::VERIFICAR:
                return "VERIFICAR";
                break;
            case $this::PAGADO:
                return "PAGADO";
                break;
        }
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkservicio0()
    {
        return $this->hasOne(Servicio::className(), ['idservicio' => 'fkservicio']);
    }

    public function getFkempresa0()
    {
        return $this->hasOne(Empresa::className(), ['idempresa' => 'fkempresa']);
    }

    
}
