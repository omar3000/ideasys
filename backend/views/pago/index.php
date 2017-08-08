<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel common\models\pagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ($searchModel->fkempresa != 0)? 'Pagos '.$nombreEmpresa : "Pagos"; // . ($_GET['id'] != 0)?  
($searchModel->fkempresa != 0)? $this->params['breadcrumbs'][] = ['label' => 'empresa', 'url' => ['empresa/view?id=' .$searchModel->fkempresa]] : "";
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

                <?=  $form->field($searchModel , 'descripcion')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar por #pago o descripcion"])->label(false); ?>
                <?= $form->field($searchModel, 'fkempresa')->hiddenInput(['class'=> 'form-control'])->label(false); ?>
           
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

    <div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="id=<?= ($searchModel->fkempresa) ?>" data-column="estatus" data-page="pago">
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
            'observacion:html',
            'pagoConfirmado',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{confirmar}',
                'buttons' => [

                    'view' => function ($url, $model) {
                        return ($model->fkservicio != null)?'<span title="Ver Servicio"  value="../servicio/view?id='.$model->fkservicio.'"  class="modalButton" ><i  class="glyphicon glyphicon-ok"></i></span>':"";
                    },
                
                    'update' => function ($url, $model) {
                        return ($model->estatus != 2)?'<span title="Actualizar Pago"  value="'.$url.'""  class="modalButton" ><i  class="glyphicon glyphicon-pencil"></i></span>':"";  

                    },

                    'confirmar' => function ($url, $model) {
                        return  ($model->pagoPendiente > 0)?
                          '<span title="Confirmar Pago"  value="'.$url.'""  class="modalButton" ><i  class="glyphicon glyphicon-usd"></i></span>':""; 


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
