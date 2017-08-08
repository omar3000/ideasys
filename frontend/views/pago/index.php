<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\pagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-index">

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

                <?=  $form->field($searchModel , 'descripcion')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar por id pago o descripcion"])->label(false); ?>
                
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

    <div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="SolicitudSearch" data-column="estatus" data-page="pago">
        <button type="button" class="btn <?= ($searchModel->st_estatus==null)?'btn-primary':'btn-default' ?>" data-value="-1">Todos</button>
        <button type="button" class="btn <?= ($searchModel->st_estatus==2)?'btn-primary':'btn-default' ?>" data-value="2">Pagado</button>
        <button type="button" class="btn <?= ($searchModel->st_estatus==0 && $searchModel->st_estatus!= null)?'btn-primary':'btn-default' ?>" data-value="0">Pendiente</button>
        <button type="button" class="btn <?= ($searchModel->st_estatus==1)?'btn-primary':'btn-default' ?>" data-value="1">Verificar</button>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
                'template' => '{view} {update}',
                'buttons' => [

                    'view' => function ($url, $model) {
                        return ($model->fkservicio != null)?'<span title="Ver Servicio"  class="modalButton" value="../servicio/view?id='.$model->fkservicio.'"><i  class="glyphicon glyphicon-ok"></i></span>':""; 


                    },
                    'update' => function ($url, $model) {
                        return ($model->pagoConfirmado + $model->pagoPendiente != $model->costo)?'<span title="Realizar Pago"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-usd"></i></span>':""; 

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
