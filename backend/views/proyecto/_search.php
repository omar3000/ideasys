<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\proyectoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idproyecto') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fecha_entrega') ?>

    <?= $form->field($model, 'st_indusoft')->checkbox() ?>

    <?php // echo $form->field($model, 'st_plc')->checkbox() ?>

    <?php // echo $form->field($model, 'st_rx3')->checkbox() ?>

    <?php // echo $form->field($model, 'st_probado')->checkbox() ?>

    <?php // echo $form->field($model, 'st_entregado')->checkbox() ?>

    <?php // echo $form->field($model, 'st_dar_prioridad')->checkbox() ?>

    <?php // echo $form->field($model, 'fecha_hr_entregado') ?>

    <?php // echo $form->field($model, 'Created_by') ?>

    <?php // echo $form->field($model, 'Updated_By') ?>

    <?php // echo $form->field($model, 'Created_At') ?>

    <?php // echo $form->field($model, 'Updated_At') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
