<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServicioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idservicio') ?>

    <?= $form->field($model, 'fkuser_solicitante') ?>

    <?= $form->field($model, 'fkuser_atendio') ?>

    <?= $form->field($model, 'fkusuario_atendio2') ?>

    <?= $form->field($model, 'fecha_hr_solicitada') ?>

    <?php // echo $form->field($model, 'fecha_hr_inicio') ?>

    <?php // echo $form->field($model, 'fecha_hr_fin') ?>

    <?php // echo $form->field($model, 'autorizo') ?>

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
