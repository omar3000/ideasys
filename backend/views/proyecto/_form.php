<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\date\DatePicker;
use dosamigos\tinymce\TinyMce;



/* @var $this yii\web\View */
/* @var $model common\models\proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-body">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    	<div class="col-md-6">
    		<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        
    	<div class="col-md-6">
            <?= $form->field($model, 'fecha_entrega')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'SELECCIONA FECHA'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                	'autoclose'=>true,
                	'format' => 'yyyy-mm-dd',
                	'todayHighlight' => true
                ],
            ]); ?>

        </div>
       
    </div>
    <div class="row">
    	<div class="col-md-12">    
            <?= $form->field($model, 'descripcion')->widget(TinyMce::className(), [
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
	    <div class="col-md-4">
	        <?= $form->field($model, 'st_indusoft')->widget(SwitchInput::classname(),['pluginOptions'=>[
	            'onText'=>'I',
	            'onColor' => 'success',
	            'offColor' => 'danger',
	            'offText'=>'O'
	        ]] );?>
	    </div>

	    <div class="col-md-4">
	        <?= $form->field($model, 'st_plc')->widget(SwitchInput::classname(),['pluginOptions'=>[
	            'onText'=>'I',
	            'onColor' => 'success',
	            'offColor' => 'danger',
	            'offText'=>'O'
	        ]] );?>
	    </div>

	    <div class="col-md-4">
	        <?= $form->field($model, 'st_rx3')->widget(SwitchInput::classname(),
	            ['pluginOptions'=>[
	                    'onText'=>'I',
	                'onColor' => 'success',
	                'offColor' => 'danger',
	                'offText'=>'O'
	                ]
	            ] 
	        );?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-4">
	        <?= $form->field($model, 'st_probado')->widget(SwitchInput::classname(),
	            ['pluginOptions'=>[
	                    'onText'=>'I',
	                'onColor' => 'success',
	                'offColor' => 'danger',
	                'offText'=>'O'
	                ]
	            ] 
	        );?>
	    </div>

	    <div class="col-md-4">
	        <?= $form->field($model, 'st_entregado')->widget(SwitchInput::classname(),
	            ['pluginOptions'=>[
	                    'onText'=>'I',
	                'onColor' => 'success',
	                'offColor' => 'danger',
	                'offText'=>'O'
	                ]
	            ] 
	        );?>
	    </div>

	    <div class="col-md-4">
	        <?= $form->field($model, 'st_dar_prioridad')->widget(SwitchInput::classname(),
	            ['pluginOptions'=>[
	                    'onText'=>'I',
	                'onColor' => 'success',
	                'offColor' => 'danger',
	                'offText'=>'O'
	                ]
	            ] 
	        );?>
	    </div>
</div>
<div class="modal-footer">
    <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>


