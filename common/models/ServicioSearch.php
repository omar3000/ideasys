<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Servicio;
use common\models\User;
use yii\db\Query;
/**
 * ServicioSearch represents the model behind the search form about `common\models\Servicio`.
 */
class ServicioSearch extends Servicio
{
    public $globalSearch;
    public $st_estatus;
    public $pagination;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idservicio', 'fkuser_solicitante', 'fkuser_atendio', 'fkusuario_atendio2'], 'integer'],
          
            [['st_estatus','fecha_hr_solicitada', 'fecha_hr_inicio', 'fecha_hr_fin', 'autorizo', 'problema', 'solucion', 'estatus', 'Created_by', 'Updated_By', 'Created_At', 'Updated_At'], 'safe'],
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

        $query = Servicio::find();
        if(Yii::$app->user->can(User::USUARIO_OPERADOR))
        {
            //$query = Servicio::find()->where(['fkuser_solicitante' => Yii::$app->user->id]);
            $query->where(['fkuser_solicitante' => Yii::$app->user->id])->limit(10);
        }
        else if(Yii::$app->user->can(User::USUARIO_PRODUCCION))
        {
            $query = Servicio::find()
                    ->innerJoin('contacto c','servicio.fkuser_solicitante = c.fkuser')
                    ->innerJoin('contacto c2', 'c2.fkuser ='.Yii::$app->user->id)
                    ->innerJoin('empresa e', 'e.idempresa = c2.fkempresa AND e.idempresa = c.fkempresa')->limit(10);

              /*
                    SELECT * FROM servicio AS s INNER JOIN contacto As c ON s.fkuser_solicitante = c.fkuser INNER JOIN contacto AS c2 On c2.fkuser = 3 Inner join empresa as e on e.idempresa = c2.fkempresa AND e.idempresa = c.fkempresa
              */
        }

 
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort' => ['defaultOrder'=>['idservicio' => SORT_DESC]],
             'pagination' => false
        ]);

        $this->load($params);
        
        if (isset($this->problema)) {
            $query->innerJoin('user u','servicio.fkuser_solicitante = u.id')
                  ->andFilterWhere(['like', 'idservicio', $this->problema .'%', false])
                  ->orFilterWhere(['like', 'u.username', $this->problema .'%', false]);
        }
        else if(isset($_GET['estatus'])){
            $query->where(['estatus' => $_GET['estatus']]);

            $this->st_estatus = $_GET['estatus'];
        }
        return $dataProvider;
    }

}
