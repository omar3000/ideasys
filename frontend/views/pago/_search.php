<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\pagoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idpago') ?>

    <?= $form->field($model, 'fkservicio') ?>

    <?= $form->field($model, 'costo') ?>

    <?= $form->field($model, 'estatus') ?>

    <?= $form->field($model, 'Created_by') ?>

    <?php // echo $form->field($model, 'Updated_By') ?>

    <?php // echo $form->field($model, 'Created_At') ?>

    <?php // echo $form->field($model, 'Updated_At') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
