<?php

use yii\helpers\Html;
use common\models\Servicio;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Servicio */

$this->title = 'Terminar servicio: ' . $model->idservicio;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idservicio, 'url' => ['view', 'id' => $model->idservicio]];
$this->params['breadcrumbs'][] = 'Finish';
?>

<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>

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
    	<div class="col-md-12">
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
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<b> Problema: </b>
    		<div>
        		<?= $model->problema ?>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
		    <?= $form->field($model, 'solucion')->widget(TinyMce::className(), [
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
</div>
<div class="modal-footer">
    <?= Html::submitButton('Terminar', ['class' => 'btn btn-success btn-lg btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>

