<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empresas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <span class="btn btn-success modalButton" value="../empresa/create/">Crear Empresa </span>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idempresa',
            'nombre',
            // 'Updated_At',

             ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>'
                        ,$url ."?estatus=0" ,[ 'title'=> 'Ver ',]);
                    },
                ]
            ]

        ],
    ]); ?>
</div>


<div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="modalContent"></div>
    </div>
</div>