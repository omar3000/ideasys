<?php

namespace backend\controllers;

use Yii;
use common\models\Contacto;
use common\models\User;
use common\models\Empresa;
use common\models\ContactoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ContactoController implements the CRUD actions for Contacto model.
 */
class ContactoController extends Controller
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
                        'actions' => ['index', 'update', 'finish', 'view', 'create', 'delete'],
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
     * Lists all Contacto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacto model in modal.
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
     * Creates a new Contacto model.
     * If creation is successful, the browser will be redirected to the 'empresa/view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Contacto();
        $userModel = new User();
        $empresasModel = new Empresa();
        $model->fkempresa = $id;
        $usuarios = $userModel->getUsersSinContacto();
        $empresas = $empresasModel->getEmpresas();

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->save(false);
            return $this->redirect(['empresa/view', 'id' => $model->fkempresa]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model, 'usuarios' => $usuarios, 'empresas' => $empresas,
            ]);
        }
    }

    /**
     * Updates an existing Contacto model.
     * If update is successful, the browser will be redirected to the 'empresa/view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userModel = new User();
        $empresasModel = new Empresa();

        $usuarios = $userModel->getUsersSinContacto();
        $empresas = $empresasModel->getEmpresas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['empresa/view', 'id' => $model->fkempresa]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model, 'usuarios' => $usuarios, 'empresas' => $empresas,
            ]);
        }
    }

    /**
     * Deletes an existing Contacto model.
     * If deletion is successful, the browser will be redirected to the 'empresa/view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()))
        {
            $model->st_actual = 1;
            $model->save(false);
            return  $this->redirect(['empresa/view', 'id' => $model->fkempresa]);
        }
        else
        {
            return $this->renderAjax('delete', [
                'model' => $model,
            ]);
        }

        
    }

    /**
     * Finds the Contacto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
