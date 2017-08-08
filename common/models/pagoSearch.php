<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pago;

/**
 * pagoSearch represents the model behind the search form about `common\models\Pago`.
 */
class pagoSearch extends Pago
{
    public $st_estatus;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpago', 'fkservicio', 'fkempresa', 'estatus'], 'integer'],
            [['costo', 'pagoPendiente', 'pagoConfirmado',], 'number'],
            [['st_estatus', 'Created_by', 'Updated_By', 'Created_At', 'Updated_At', 'descripcion'], 'safe'],
            [['st_actual'], 'boolean'],
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
    public function search($params, $id = 0, $estatus = 1)
    {
        $query = Pago::find();
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (isset($this->descripcion)) {
            $query->where(['like', 'pago.idpago', $this->descripcion.'%', false])
                  ->orFilterWhere(['like', 'pago.descripcion', $this->descripcion .'%', false]);
          
        }
        else if(isset($_GET['estatus'])){
            $query->andFilterWhere(['pago.estatus' => $_GET['estatus']]);
            $this->st_estatus = $_GET['estatus'];
        }

        if($id != 0)
        {
        	$query->andFilterWhere(['pago.fkempresa' => $id]);
        }
        else if (isset($this->fkempresa))
        {
        	if($this->fkempresa != 0)
            	$query->andFilterWhere(['pago.fkempresa' => $this->fkempresa]);
        }
        
        if($estatus == 0)
          	$query->andFilterWhere(['pago.estatus' => $estatus]);
        
        $query->andFilterWhere(['pago.st_actual' => 0]);  
        return $dataProvider;
    }
}
