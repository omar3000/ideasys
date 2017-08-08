<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Notificar */

$this->title = 'Create Notificar';
$this->params['breadcrumbs'][] = ['label' => 'Notificars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
