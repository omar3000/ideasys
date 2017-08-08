<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\User;
use yii\bootstrap\Modal;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Empresa */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="empresa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=(Yii::$app->user->can(User::USUARIO_ADMINISTRATIVO))?'<span class="btn btn-success modalButton" value="../pago/create?id=' .$model->idempresa.'">Crear Pago </span>':"" ?>  
        <?=(Yii::$app->user->can(User::USUARIO_ADMINISTRATIVO))? Html::a('Historial de pagos', ['pago/index?id=' .$model->idempresa], ['class' => 'btn btn-success']):"" ?>
    </p>    

    <?php $form = ActiveForm::begin([
        'action' => ['empresa/view?id=' .$model->idempresa],
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

                <?=  $form->field($searchModelPagos , 'descripcion')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar por #pago o descripcion"])->label(false); ?>
           
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
    <?= GridView::widget([
        'dataProvider' => $dataPagos,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idpago',
            [
                'attribute' => 'an_attributeid',
                'label' => 'Costo',
                'value' => function($model) { return "$" .$model->costo ;},
            ],
            'descripcion:html',
            'Sestatus',
            'observacion',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{servicio/view}',
                'buttons' => [

                    'servicio/view' => function ($url, $model) {
                        return ($model->fkservicio != null)?'<span title="Ver Servicio" class="modalButton" value="../servicio/view?id='.$model->fkservicio.'"><i  class="glyphicon glyphicon-ok"></i></span>':"";
                    },

                ],
            ],
        ],
    ]); ?>

        <p>
            <?=(Yii::$app->user->can(User::USUARIO_ISOPORTE))? '<span class="btn btn-success modalButton" value="../contacto/create?id=' .$model->idempresa.'">Agregar contacto </span>':"" ?>
        </p>
        

        <?php 
             $form = ActiveForm::begin([
                'action' => ['empresa/view?id=' .$model->idempresa],
                'method' => 'get',
                'id'=>'searchForm',
                'fieldConfig' => [
                    'template' => "{input}",
                    'options' => [
                        'tag'=>'span'
                    ]
                ],
            ]); 
        ?>

        <div id="custom-search-input">
            <div class="input-group col-md-12">

                <?=  $form->field($searchModel , 'nombre')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar por nombre"])->label(false); ?>
           
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
    <div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="id=<?=($model->idempresa);?>" data-column="usuario" data-page="empresa">
        <button type="button" class="btn <?= ($searchModel->st_rol==null)?'btn-primary':'btn-default' ?>" data-value="-1">Todos</button>
        <button type="button" class="btn <?= ($searchModel->st_rol==User::USUARIO_OPERADOR)?'btn-primary':'btn-default' ?>" data-value="<?= (User::USUARIO_OPERADOR) ?>">Operadores</button>
        <button type="button" class="btn <?= ($searchModel->st_rol==User::USUARIO_PRODUCCION)?'btn-primary':'btn-default' ?>" data-value="<?= (User::USUARIO_PRODUCCION) ?>">Jefes de Produccion</button>
        <button type="button" class="btn <?= ($searchModel->st_rol==User::USUARIO_PAGOS )?'btn-primary':'btn-default' ?>" data-value="<?= (User::USUARIO_PAGOS) ?>">Administradores</button>

        <button type="button" class="btn <?= ($searchModel->st_rol=="1")?'btn-primary':'btn-default' ?>" data-value="1">Otros</button>
    </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'idcontacto',
                'nombre',
                'telefono',
                'movil',
                'correo',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{view}{notificar}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return (Yii::$app->user->can(User::USUARIO_ISOPORTE))?'<span title="Actualizar contacto"  value="../contacto/update?id='.$model->idcontacto.'"  class="modalButton" ><i  class="glyphicon glyphicon-refresh"></i></span>':"";
                        },

                        /*'delete' => function ($url, $model) {
                           return (Yii::$app->user->can(User::USUARIO_ISOPORTE))?Html::a('<i class="glyphicon glyphicon-remove"></i>'
                            ,['contacto/delete','id' => $model->idcontacto] , ['data' => [ 'confirm' => 'esta seguro de eliminar el contacto?',
                            'method' => 'post', 'pjax'=>"0"]]):"";
                        },*/

                        
                        'view' => function ($url, $model) {
                            return (Yii::$app->user->can(User::USUARIO_ISOPORTE))?'<span title="Ver contacto"  value="../contacto/view?id='.$model->idcontacto.'"  class="modalButton" ><i  class="glyphicon glyphicon-eye-open"></i></span>':"";
                        },

                        'notificar' => function($url, $model ){
                            return (Yii::$app->user->can(User::USUARIO_ISOPORTE))?
                            Html::a('<i class="glyphicon glyphicon-tags"></i>'
                            ,["notificar/index?id=$model->idcontacto&empresa=$model->fkempresa."]):"";
                        
                        } 
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