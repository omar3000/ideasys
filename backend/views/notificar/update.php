<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notificar */

$this->title = 'Update Notificar: ' . $model->idnotificar;
$this->params['breadcrumbs'][] = ['label' => 'Notificars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnotificar, 'url' => ['view', 'id' => $model->idnotificar]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notificar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
