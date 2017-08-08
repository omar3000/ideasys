<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property integer $idproyecto
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha_entrega
 * @property boolean $st_indusoft
 * @property boolean $st_plc
 * @property boolean $st_rx3
 * @property boolean $st_probado
 * @property boolean $st_entregado
 * @property boolean $st_dar_prioridad
 * @property string $fecha_hr_entregado
 * @property string $Created_by
 * @property string $Updated_By
 * @property string $Created_At
 * @property string $Updated_At
 */
class proyecto2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'Created_by', 'Created_At'], 'required'],
            [['fecha_entrega', 'fecha_hr_entregado', 'Created_At', 'Updated_At'], 'safe'],
            [['st_indusoft', 'st_plc', 'st_rx3', 'st_probado', 'st_entregado', 'st_dar_prioridad'], 'boolean'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 5000],
            [['Created_by', 'Updated_By'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproyecto' => 'Idproyecto',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'fecha_entrega' => 'Fecha Entrega',
            'st_indusoft' => 'St Indusoft',
            'st_plc' => 'St Plc',
            'st_rx3' => 'St Rx3',
            'st_probado' => 'St Probado',
            'st_entregado' => 'St Entregado',
            'st_dar_prioridad' => 'St Dar Prioridad',
            'fecha_hr_entregado' => 'Fecha Hr Entregado',
            'Created_by' => 'Created By',
            'Updated_By' => 'Updated  By',
            'Created_At' => 'Created  At',
            'Updated_At' => 'Updated  At',
        ];
    }
}
