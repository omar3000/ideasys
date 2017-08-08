<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmpresaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idempresa') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'Created_by') ?>

    <?= $form->field($model, 'Updated_By') ?>

    <?= $form->field($model, 'Created_At') ?>


    <?php // echo $form->field($model, 'Updated_At') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
