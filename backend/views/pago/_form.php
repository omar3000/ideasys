<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use dosamigos\tinymce\TinyMceAsset;

TinyMceAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Pago */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">    
            <?= $form->field($model, 'descripcion')->textInput() ?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">    
            <?= $form->field($model, 'observacion')->widget(TinyMce::className(), [
                'options' => ['rows' => 6],
                'language' => 'es',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                ]
            ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">    
            <?= $form->field($model, 'costo')->textInput() ?>
        </div>    
        <div class="col-md-6">    
            <?php
                echo $form->field($model, 'fkempresa')->widget(Select2::classname(), [
                    'data' => $empresas,
                    'options' => ['placeholder' => 'SELECCIONA EMPRESA'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); 
            ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?= Html::submitButton('Confirmar', ['class' => 'btn btn-success btn-lg btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>








