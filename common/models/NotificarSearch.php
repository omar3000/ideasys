<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notificar;
use common\models\Contacto;

/**
 * NotificarSearch represents the model behind the search form about `common\models\Notificar`.
 */
class NotificarSearch extends Notificar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnotificar', 'fkcontacto', 'fkcontacto_notificar'], 'integer'],
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

        $this->load($params);
        $query = Contacto::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

       

    
        /*
        // grid filtering conditions
        $query->andFilterWhere([
            'idnotificar' => $this->idnotificar,
            'fkcontacto' => $this->fkcontacto,
            'fkcontacto_notificar' => $this->fkcontacto_notificar,
        ]);
        */
        return $dataProvider;
    }
}
