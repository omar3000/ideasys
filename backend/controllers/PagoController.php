<?php

namespace backend\controllers;

use Yii;
use common\models\Pago;
use common\models\Empresa;
use common\models\pagoSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PagoController implements the CRUD actions for Pago model.
 */
class PagoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'confirmar', 'view', 'delete', 'create'],
                        'allow' => true,
                        'roles' => [User::USUARIO_ADMINISTRATIVO],
                    ],
 
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists of  Pago models of one Empresa models.
     * @param integer $id
     * @return mixed
     */
    public function actionIndex($id = 0)
    {
        $searchModel = new pagoSearch();
        //$searchModel->load(Yii::$app->request->post());
        $searchModel->fkempresa = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
  
        if( $searchModel->fkempresa != 0)
        {
            $empresaModel = Empresa::find()->where(['idempresa' => $searchModel->fkempresa])->one();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'nombreEmpresa' => $empresaModel->nombre,
            ]);
        }
        else
        {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'nombreEmpresa' => "",
            ]);
        }
    }

    /**
     * Displays a single Pago model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pago model.
     * If creation is successful, the browser will be redirected to the 'empresa/view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $empresasModel = new Empresa();
        $model = new Pago();
        $model->fkempresa = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['empresa/view', 'id' => $model->fkempresa]);
        } else {

            $empresas = $empresasModel->getEmpresas();
            return $this->renderAjax('create', [
                'model' => $model,
                'empresas' => $empresas,
            ]);
        }
    }

    /**
     * Updates an existing Pago model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $empresasModel = new Empresa();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            $model->save(false);
            return $this->redirect(['index', 'id' => $model->fkempresa]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'empresas' => $empresasModel->getEmpresas(),
            ]);
        }
    }

    /**
     * Pago confirmado 
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionConfirmar($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()))
        {
            $model->pagoConfirmado = $model->pagoConfirmado + $model->pagoPendiente;
            $model->pagoPendiente = 0;
            if($model->costo == $model->pagoConfirmado)
            {
                $model->estatus = 2;
            }
            else
            {
                $model->estatus = 1;
            }
            $model->save(false);
            return $this->redirect(['index', 'id' => $model->fkempresa]);
        }
        else
        {
            return $this->renderAjax('confirmar', ['model' => $model,]);
        }

    }

    /**
     * Deletes an existing Pago model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->load(Yii::$app->request->post());
        $model->st_actual = 1;
        $model->save(false);

        return $this->redirect(['index', 'id' => $model->fkempresa]);
    }

    /**
     * Finds the Pago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pago::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
