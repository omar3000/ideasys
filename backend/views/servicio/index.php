<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Servicio;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInputAsset;

SwitchInputAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel common\models\ServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicios';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="servicio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id'=>'searchForm',
        'fieldConfig' => [
            'template' => "{input}",
            'options' => [
                'tag'=>'span'
            ]
        ],
    ]); ?>

        <div id="custom-search-input">
            <div class="input-group col-md-12">

                <?=  $form->field($searchModel , 'problema')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar por id servicio o usuario solicitante"])->label(false); ?>
           
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info" id="reset" >
                            <i class="glyphicon glyphicon-erase"></i>
                        </button>
                        <button type="submit" class="btn btn-info" >
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
            </div>
        </div>
    
    <?php  ActiveForm::end(); ?>
    <br/>



    <div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="SolicitudSearch" data-column="estatus" data-page="servicio">
        <button type="button" class="btn <?= ($searchModel->st_estatus==null)?'btn-primary':'btn-default' ?>" data-value="-1">Todos</button>
        <button type="button" class="btn <?= ($searchModel->st_estatus==1)?'btn-primary':'btn-default' ?>" data-value="1">Pendiente</button>
        <button type="button" class="btn <?= ($searchModel->st_estatus==2)?'btn-primary':'btn-default' ?>" data-value="2">atendido</button>
        <button type="button" class="btn <?= ($searchModel->st_estatus==3)?'btn-primary':'btn-default' ?>" data-value="3">Finalizado</button>
    </div>


</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /*    
            'idservicio',
            [ 
                'attribute'=> 'fkuser_solicitante',
                'value'=>function($model){
                    return $model->getUser($model->fkuser_solicitante);
                }
            ],*/



            'idservicio',
            'fkuserSolicitante.username',
            'Sestatus',
            'fkuserAtendio.username',
            'fkusuarioAtendio2.username',
            'fecha_hr_solicitada',
            [ 
                'attribute'=> 'Empresa',
                'value'=>function($model){
                    return $model->getEmpresa($model->fkuser_solicitante);
                },
            ],



            // 'fecha_hr_inicio',
            // 'fecha_hr_fin',
            // 'autorizo',
            // 'Created_by',
            // 'Updated_By',
            // 'Created_At',
            // 'Updated_At',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{start}{notificar}{update}{finish}{view}',
            'buttons' => [
                'start' => function ($url, $model) {
                    return ($model->estatus == Servicio::CREADO)?'<span title="Iniciar Servicio"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-play-circle"></i></span>':"";
                },
     
                'notificar' => function ($url, $model) {
                    return ($model->estatus == Servicio::CREADO)?Html::a('<i class="glyphicon glyphicon-tags"></i>'
                    ,$url ,['title'=> 'Notificar',]):"";
                },

                'update' => function ($url, $model) {
                    return ($model->estatus == Servicio::INICIADO && (Yii::$app->user->id == isset($model->fkuserAtendio) || Yii::$app->user->id == isset($model->fkusuarioAtendio2)))? '<span title="Actualizar Servicio"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-refresh"></i></span>':"";   
                },
                
                'finish' => function ($url, $model) {
                    return ($model->estatus == Servicio::INICIADO && (Yii::$app->user->id == isset($model->fkuserAtendio) || Yii::$app->user->id == isset($model->fkusuarioAtendio2)))?'<span title="Terminar Servicio"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-floppy-saved"></i></span>':'';
                },

                'view' => function ($url, $model) {
                    return ($model->estatus == Servicio::FINALIZADO)?'<span title="Ver"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-eye-open"></i></span>':'';
                },


            ],
       ],

        ],
    ]); ?>

    <div class="modal fade" id="modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="modalContent"></div>
        </div>
    </div>
</div>
