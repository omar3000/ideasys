<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NotificarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notificar';
$this->params['breadcrumbs'][] = ['label' => $model->fkempresa, 'url' => ['empresa/view?', 'id' => $model->fkempresa , 'estatus' => 0 ]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<div class="modal-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'st_estatus:boolean',
            
            ['class' => 'yii\grid\ActionColumn',

                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',Url::to(['notificar/update', 'id' => $model->idcontacto , 'contacto'=> $_GET['id'] , 'estatus'=>$model->st_estatus]));

                    },
                ],
            ],
        ],
    ]); ?>

   
</div>

