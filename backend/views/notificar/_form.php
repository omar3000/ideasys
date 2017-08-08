<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Notificar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fkcontacto')->textInput() ?>

    <?= $form->field($model, 'fkcontacto_notificar')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
