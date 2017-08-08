<?php

namespace backend\controllers;

use Yii;
use common\models\Notificar;
use common\models\NotificarSearch;
use common\models\ContactoSearch;
use common\models\Contacto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificarController implements the CRUD actions for Notificar model.
 */
class NotificarController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notificar models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new ContactoSearch();
        $dataProvider = $searchModel->notificar(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Notificar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notificar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notificar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idnotificar]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Notificar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $contacto, $estatus)
    {
        $model = new Notificar();
    	if($estatus == 0)
    	{
    		$model->fkcontacto = $contacto;
    		$model->fkcontacto_notificar = $id;
    		$model->save();
    	}
    	else
    	{
            $model = Notificar::find()->where(['fkcontacto' => $contacto, 'fkcontacto_notificar' => $id])->one();  
    		$this->findModel($model->idnotificar)->delete();
    	}
    	
        $model = new Contacto(); 
        $model = Contacto::find()->where(['idcontacto' => $id])->one();
        return $this->redirect(['index', 'id' => $contacto, 'empresa' => $model->fkempresa]);
        //return $this->redirect(['empresa/view', 'id' => $model->fkempresa]); 
    }

    /**
     * Deletes an existing Notificar model.
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
     * Finds the Notificar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notificar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notificar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
