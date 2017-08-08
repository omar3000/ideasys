<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Empresa;

/**
 * EmpresaSearch represents the model behind the search form about `common\models\Empresa`.
 */
class EmpresaSearch extends Empresa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idempresa'], 'integer'],
            [['nombre', 'Created_by', 'Updated_By', 'Created_At', 'Updated_At'], 'safe'],
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
        $query = Empresa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idempresa' => $this->idempresa,
            'Created_At' => $this->Created_At,
            'Updated_At' => $this->Updated_At,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'Created_by', $this->Created_by])
            ->andFilterWhere(['like', 'Updated_By', $this->Updated_By]);

        return $dataProvider;
    }
}
