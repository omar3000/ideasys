<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\models\User;


/* @var $this yii\web\View */
/* @var $searchModel common\models\ServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=(Yii::$app->user->can(User::USUARIO_OPERADOR))?'<span  value="../servicio/create"  class="btn btn-success modalButton" >Solicitar servicio</span>':"" ?>
    </p>

    <?php 
        if(Yii::$app->user->can(User::USUARIO_PRODUCCION))
        {
            $form = ActiveForm::begin([
                'action' => ['index'],
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
    
    <?php 
            ActiveForm::end();
        } 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      // 'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idservicio',
            'fecha_hr_solicitada',
            'fkuserSolicitante.username',
            'Sestatus',
            'fkuserAtendio.username',
            'fkusuarioAtendio2.username',
            // 'fecha_hr_inicio',
            // 'fecha_hr_fin',
            // 'autorizo',
            // 'Created_by',
            // 'Updated_By',
            // 'Created_At',
            // 'Updated_At',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{create}',
                'buttons' => [
                    /*
                    'index' => function ($url, $model) {
                        return ($model->estatus != 4 && Yii::$app->user->can(User::USUARIO_PAGOS))?Html::a('<i class="glyphicon glyphicon-play-circle"></i>'
                        ,$url ,['title'=> 'Pagar',]):"";
                    }*/
                    'view' => function ($url, $model) {
                        return '<span title="Ver"  value="'.$url.'"  class="modalButton" ><i  class="glyphicon glyphicon-eye-open"></i></span>';
                    },
                
                ],
            ],
        ]
    ]);?>

    <div class="modal fade" id="modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="modalContent"></div>
        </div>
    </div>
</div>
