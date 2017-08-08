<?php

namespace backend\controllers;

use Yii;
use common\models\proyecto;
use common\models\User;
use common\models\proyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProyectoController implements the CRUD actions for proyecto model.
 */
class ProyectoController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'finish'],
                        'allow' => true,
                        'roles' => [User::USUARIO_ISOPORTE]
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
     * Lists all proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new proyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single proyecto model.
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
     * Creates a new proyecto model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new proyecto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            mkdir('C:/xampp/htdocs/ideasys/proyectos/'.$model->nombre, 0777, true);
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing proyecto model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $this->layout = "blank";
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * se finaliza el proyecto y se guarda la fecha
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionFinish($id)
    {
        $model = $this->findModel($id);
        $model->load(Yii::$app->request->post());
        if($model->fecha_hr_entregado == null)
        {
            $model->fecha_hr_entregado = date('Y-m-d H:i:s');
            $model->save(false);
        }
        return $this->actionIndex();
                  
    }

    /**
     * Deletes an existing proyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = proyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
