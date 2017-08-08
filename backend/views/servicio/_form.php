<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\select2\Select2;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Servicio */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('ideasys/backend/web/js/servicio.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]); ?>

<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'solicitante')->textInput(['readonly' => true]) ?>
        </div>
        <div class="col-md-6">    
            <?= $form->field($model, 'autorizo')->textInput(['readonly' => true]) ?>
        </div>    
    </div>
    
    <div class="row">
        <div class="col-md-9">
            <?php
                echo $form->field($model, 'fkusuario_atendio2')->widget(Select2::classname(), [
                    'data' => $usuarios,
                    'options' => ['placeholder' => 'SELECCIONA USUARIO'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); 
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'principal')->widget(SwitchInput::classname(),[] );?>
        </div>   

    </div>
    
    <b> Problema: </b>
    <div>
        <?= $model->problema ?>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'stcosto0')->widget(SwitchInput::classname(),[] );?>
        </div>
        <div class="col-md-9 col-md-offset-1">
            <div id="razon0">
                <?= $form->field($model,'razon0'); ?>
            </div>
        </div>
    </div>
</div>    
<div class="modal-footer">
    <?= Html::submitButton($model->estatus == $estatus ? 'Iniciar' : 'Actualizar', ['class' => $model->estatus == $estatus ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>
