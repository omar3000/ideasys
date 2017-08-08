<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pago */

$this->title = $model->idpago;
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idpago',
            'fkservicio',
            'costo',
            'Sestatus',
            'descripcion',
            'observacion:html',
            'pagoPendiente',
        ],
    ]) ?>

</div>
