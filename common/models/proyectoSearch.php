<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\proyecto;

/**
 * proyectoSearch represents the model behind the search form about `common\models\proyecto`.
 */
class proyectoSearch extends proyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idproyecto'], 'integer'],
            [['nombre', 'descripcion', 'fecha_entrega', 'fecha_hr_entregado', 'Created_by', 'Updated_By', 'Created_At', 'Updated_At'], 'safe'],
            [['st_indusoft', 'st_plc', 'st_rx3', 'st_probado', 'st_entregado', 'st_dar_prioridad'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = proyecto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (isset($this->nombre)) {
            $query->andFilterWhere(['like', 'nombre', $this->nombre.'%', false]);

        }

        /*
        // grid filtering conditions
        $query->andFilterWhere([
            'idproyecto' => $this->idproyecto,
            'fecha_entrega' => $this->fecha_entrega,
            'st_indusoft' => $this->st_indusoft,
            'st_plc' => $this->st_plc,
            'st_rx3' => $this->st_rx3,
            'st_probado' => $this->st_probado,
            'st_entregado' => $this->st_entregado,
            'st_dar_prioridad' => $this->st_dar_prioridad,
            'fecha_hr_entregado' => $this->fecha_hr_entregado,
            'Created_At' => $this->Created_At,
            'Updated_At' => $this->Updated_At,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'Created_by', $this->Created_by])
            ->andFilterWhere(['like', 'Updated_By', $this->Updated_By]); */

        return $dataProvider;
    }
}
