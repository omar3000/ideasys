<?php

namespace backend\controllers;

use Yii;
use common\models\Servicio;
use common\models\Pago;
use common\models\User;
use common\models\Contacto;
use common\models\ServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * ServicioController implements the CRUD actions for Servicio model.
 */
class ServicioController extends Controller
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
                        'actions' => ['index', 'update', 'finish', 'view', 'start', 'notificar'],
                        'allow' => true,
                        'roles' => [User::USUARIO_ISOPORTE],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [User::USUARIO_ADMINISTRATIVO]
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
     * Lists all Servicio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servicio model.
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
     * Updates an existing Servicio model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionStart($id)
    {
        $model = $this->findModel($id);

        $userModel = new User();
        $todosUsuarios = $userModel->getUsers();
        $userModel = User::find()->where(['id' => $model->fkuser_solicitante])->one();
        if ($model->load(Yii::$app->request->post())) 
        {
            if($model->principal)
            {
                $model->fkuser_atendio = $model->fkusuario_atendio2;
                $model->fkusuario_atendio2 = Yii::$app->user->id; 
            }
            else
            {
                $model->fkuser_atendio = Yii::$app->user->id;
                $model->fkusuario_atendio2 = $model->fkusuario_atendio2;
            }
            $model->fecha_hr_inicio = date('Y-m-d H:i:s');
            $model->estatus = Servicio::INICIADO;

            $model->save(false);
            return $this->redirect(['index']);
        } else {
            $model->solicitante = $userModel->username;
            return $this->renderAjax('start', [
                'model' => $model, 'estatus' => Servicio::CREADO, 'usuarios' => $todosUsuarios, 
            ]);
        }
    }

    /**
     * Updates an existing Servicio model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userModel = new User();
        $todosUsuarios = $userModel->getUsers();
        $userModel = User::find()->where(['id' => $model->fkuser_solicitante])->one();

        if ($model->load(Yii::$app->request->post())) {
            if($model->principal)
            {
                $model->fkuser_atendio = $model->fkusuario_atendio2;
                $model->fkusuario_atendio2 = Yii::$app->user->id; 
            }
            else
            {
                $model->fkuser_atendio = Yii::$app->user->id;
                $model->fkusuario_atendio2 = $model->fkusuario_atendio2;
            }
            $model->save(false);
            return $this->redirect(['index']);
        } else {
            $model->solicitante = $userModel->username;
            return $this->renderAjax('update', [
                'model' => $model, 'solicitante' => $userModel->username, 'estatus' => Servicio::CREADO, 'usuarios' => $todosUsuarios,
            ]);
        }
    }

    

    public function actionNotificar($id)
    {
         $userModel = new User();
         $model = $this->findModel($id);
         $userModel = User::find()->where(['id' => $model->fkuser_solicitante])->one();     //getUser($model->fkuser_atendio );

         Yii::$app->mailer->compose()
            ->setFrom('francoalvarezomar@gmail.com')
            ->setTo($userModel->email)
            ->setSubject('Notificacion de servicio Solicitado #' .$model->idservicio)
            ->setTextBody('El servicio ha sido revisado en breve lo iniciaremos y resolveremos')
            ->send();

        return $this->actionIndex();

    } 


    public function actionFinish($id)
    {
        $model = $this->findModel($id);
        $modelPagos = new Pago();
        $userModel = new User();
        $contactoModel =  Contacto::find()->where(['fkuser' => $model->fkuser_solicitante])->one();
        $todosUsuarios = $userModel->getUsers();
        $userModel = User::find()->where(['id' => $model->fkuser_solicitante])->one();
        
        if ($model->load(Yii::$app->request->post())) 
        {
            $model->fecha_hr_fin = date('Y-m-d H:i:s');
            $model->estatus = Servicio::FINALIZADO;
            $model->save(false);

            $modelPagos->fkservicio = $model->idservicio;
            $modelPagos->estatus = 0;               
            $modelPagos->fkempresa = $contactoModel->fkempresa;
            $hora = date("G",  strtotime($model->fecha_hr_solicitada));
            if($model->razon0 != null)
            {
                $modelPagos->costo = 0;
            }
            else if($hora > 16)
            {
                 $modelPagos->costo = Servicio::COSTO_EXTRA;
            }
            else
            {
                $modelPagos->costo= Servicio::COSTO_NORMAL;
            }
            $modelPagos->descripcion = "servicio: F" .$model->idservicio;
            $modelPagos->save(false);

            return $this->redirect(['index']);
        } else {
             $model->solicitante = $userModel->username;
            return $this->renderAjax('finish', [
                'model' => $model,
                'solicitante' => $userModel->username,
                'usuarios' => $todosUsuarios, 
            ]);
        }
    }

    /**
     * Deletes an existing Servicio model.
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
     * Finds the Servicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servicio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
