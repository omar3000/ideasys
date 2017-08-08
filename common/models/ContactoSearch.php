<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contacto;

/**
 * ContactoSearch represents the model behind the search form about `common\models\Contacto`.
 */
class ContactoSearch extends Contacto
{
    public $st_rol; 


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcontacto', 'fkuser', 'fkempresa'], 'integer'],
            [['st_rol', 'nombre', 'telefono', 'movil', 'correo', 'Created_by', 'Updated_By', 'Created_At', 'Updated_At'], 'safe'],
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


    public function notificar($params)
    {
        $this->load($params);
        $query = Contacto::find()->select(['contacto.nombre', 'contacto.idcontacto', 'st_estatus' => '(CASE WHEN n.fkcontacto_notificar is null  THEN 0 when n.fkcontacto ="'.$_GET['id'].'" then 1  ELSE 1 END)'])
        ->leftJoin('notificar n', 'n.fkcontacto_notificar = contacto.idcontacto AND n.fkcontacto ="'.$_GET['id'].'"')
        ->leftJoin('user u','u.id = contacto.fkuser or  u.id is null') 
        ->leftJoin('auth_assignment a','((u.id= a.user_id) AND (a.item_name != "operador"))')
        ->where(['contacto.fkempresa' => $_GET['empresa']])
        ->andFilterWhere(['contacto.st_actual' => 0]);


        /*select c.nombre,( CASE WHEN n.fkcontacto_notificar  is null THEN 0  ELSE 1 END) AS estatus from contacto as c LEFT JOIN notificar as n on n.fkcontacto_notificar = c.idcontacto inner join auth_assignment as a on c.fkuser= a.user_id AND (a.item_name ="pagos" or a.item_name ="jefeProduccion") 
where c.fkempresa = 1 */

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
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
        if(isset($_GET['usuario']))
        {

                if($_GET['usuario'] != '1')
                {
                    
                     $query->innerJoin('auth_assignment a','contacto.fkuser= a.user_id AND a.item_name =\'' .$_GET['usuario'] .'\'')
                        ->where(['contacto.fkempresa' => $_GET['id']]);

                    $this->st_rol = $_GET['usuario'] ;
                }
                else
                {
                    $query->Where(['contacto.fkempresa' => $_GET['id'] , 'contacto.fkuser' => null]);
                    $this->st_rol = 1;
                }
            
        }





        if(isset($_GET['id']))
        {
            $query->where(['contacto.fkempresa' => $_GET['id']]);
        }
        else 
        {
            $query->Where(['contacto.fkempresa' => $_GET['id']]);
        }

        if (isset($this->nombre)) {
            $query->andFilterWhere(['like', 'idcontacto', $this->nombre.'%', false])
                  ->orFilterWhere(['like', 'nombre', $this->nombre .'%', false])->limit(10);
        }


        $query->andFilterWhere(['st_actual' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
        
    }
}
