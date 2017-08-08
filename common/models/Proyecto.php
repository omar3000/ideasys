<?php

namespace common\models;

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
class Proyecto extends \yii\db\ActiveRecord
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
            [['nombre'], 'required'],
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
            'st_indusoft' => 'Indusoft',
            'st_plc' => 'Plc',
            'st_rx3' => 'Rx3',
            'st_probado' => 'Probado',
            'st_entregado' => 'Entregado',
            'st_dar_prioridad' => 'Dar Prioridad',
            'fecha_hr_entregado' => 'Fecha Hr Entregado',
        ];
    }
}
