<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInputAsset;

SwitchInputAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel common\models\proyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <span class="btn btn-success modalButton" value="../proyecto/create">Agregar Proyecto </span>
    </p>

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

                <?=  $form->field($searchModel , 'nombre')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar por nombre"])->label(false); ?>
           
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn" id="reset" >
                            <i class="glyphicon glyphicon-erase"></i>
                        </button>
                        <button type="submit" class="btn btn-info btn" >
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
            </div>
        </div>
    
    <?php  ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'idproyecto',
            'nombre',
            'descripcion:html',
            'fecha_entrega:date',
            'st_indusoft:boolean',
            'st_plc:boolean',
            'st_rx3:boolean',
            'st_probado:boolean',
            'st_entregado:boolean',
            'st_dar_prioridad:boolean',
            'fecha_hr_entregado',
            // 'Created_by',
            // 'Updated_By',
            // 'Created_At',
            // 'Updated_At',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}{finish}{view}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return($model->fecha_hr_entregado == null)?'<span title="Actualizar Proyecto"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-refresh"></i></span>':'';
                },

 

                'finish' => function ($url, $model) {
                    return ($model->st_indusoft && $model->st_plc && $model->st_rx3 && $model->st_probado && $model->st_entregado && $model->st_dar_prioridad && $model->fecha_hr_entregado == null)?'<span title="Terminar Proyecto"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-ok-sign"></i></span>':'';
                },



                'view' => function ($url, $model) {
                    return ($model->fecha_hr_entregado != null)?'<span title="Ver proyecto"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-eye-open"></i></span>':'';
                },


            ],],
        ],
    ]); ?>

        <div class="modal fade" id="modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="modalContent"></div>
        </div>
    </div>
</div>
