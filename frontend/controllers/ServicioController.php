<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Servicio;
use common\models\ServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
                        'actions' => ['create', 'index', 'view'],
                        'allow' => true,
                        'roles' => [User::USUARIO_OPERADOR]
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => [User::USUARIO_PRODUCCION]
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [User::USUARIO_PAGOS]
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


      //  $example = $searchModel->example();
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
     * Creates a new Servicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Servicio();
        $hora = date("G");
        $costo;
        $userModel = new User();
        $userModel = User::find()->where(['id' => Yii::$app->user->id])->one();
        if($hora > 16)
        {
            $costo = Servicio::COSTO_EXTRA;
        }
        else
        {
            $costo = Servicio::COSTO_NORMAL;
        }


        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_hr_solicitada = date('Y-m-d H:i:s');
            $model->fkuser_solicitante = Yii::$app->user->id; 
            $model->estatus = Servicio::CREADO;
            $model->save(false);
            $this->sendEmail($model, $userModel->username); 
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'costo' => $costo,
            ]);
        }
    }

    public function sendEmail($model, $solicitante)
    {
        $userModel = new User();
        $users = $userModel->getEmailUser($model->fkuser_solicitante);
        $userModel = User::find()->where(['id' => $model->fkuser_solicitante])->one();    //getUser($model->fkuser_atendio );
        $atendio = $userModel->email;
        $fechaS = date("d-m-Y H:i:s",strtotime($model->fecha_hr_solicitada));
        
        //$atendio = $model->fkuserAtendio.username; 
        $messages = [];
        foreach ($users as $user) {
            $messages[] = Yii::$app->mailer->compose()
                ->setFrom('francoalvarezomar@gmail.com')
                ->setTo($user['correo'])
                ->setSubject('Servicio solicitado ' .$model->idservicio)
                ->setHtmlBody('Solicitante: ' .$solicitante .'<br /> Fecha de solicitud: ' .$fechaS  
                .'<br /> Prolema: ' .$model->problema 
                .'<br /> Autorizo el servicio: ' .$model->autorizo
                .'<br /> Fecha de inicio del servicio: ' .$model->fecha_hr_inicio
                .'<br /> Usuario que atendio el servicio: ' .$atendio);
        }
        Yii::$app->mailer->sendMultiple($messages); 
    }

    /**
     * Updates an existing Servicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idservicio]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
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
