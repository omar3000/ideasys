<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;



/* @var $this yii\web\View */
/* @var $model common\models\Contacto */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-10">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-offset-.5 col-md-5">
                <?= $form->field($model, 'movil')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <?= $form->field($model, 'correo')->input('email') ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-10">
                <?php
                    echo $form->field($model, 'fkempresa')->widget(Select2::classname(), [
                        'data' => $empresas,
                        'options' => ['placeholder' => 'SELECCIONA EMPRESA'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],]); 
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-.8 col-md-10">
                <?php
                    echo $form->field($model, 'fkuser')->widget(Select2::classname(), [
                        'data' => $usuarios,
                        'options' => ['placeholder' => 'SELECCIONA USUARIO'],
                        'pluginOptions' => [
                        'allowClear' => true
                    ],]); 
                ?>
            </div>
        </div>
    </div>
    
    <div class="modal-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

   


