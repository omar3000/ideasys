<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Notificar */

$this->title = $model->idnotificar;
$this->params['breadcrumbs'][] = ['label' => 'Notificars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idnotificar], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idnotificar], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idnotificar',
            'fkcontacto',
            'fkcontacto_notificar',
        ],
    ]) ?>

</div>
