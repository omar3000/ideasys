<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcontacto') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'movil') ?>

    <?= $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'fkuser') ?>

    <?php // echo $form->field($model, 'st_actual')->checkbox() ?>

    <?php // echo $form->field($model, 'fkempresa') ?>

    <?php // echo $form->field($model, 'enviarCorreo')->checkbox() ?>

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
