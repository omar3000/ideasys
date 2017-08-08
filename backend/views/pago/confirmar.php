<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use yii\widgets\DetailView;

?>

	<?php $form = ActiveForm::begin(); ?>
	
	<div class="modal-header modal-header-warning">
        <?=(' Confirmar un pago pendiente')?>
    </div>
      <div class="modal-body">
      	<div class="row">
    		<?= DetailView::widget([
        		'model' => $model,
        		'attributes' => [
            		'idpago',
            		'fkservicio',
            		'descripcion',
            		'Sestatus',
        		],
    		]) ?>
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
            <div class="col-md-4">    
            	<?= $form->field($model, 'pagoPendiente')->textInput(['readonly' => true]) ?>
            </div>
            <div class="col-md-4">    
            	<?= $form->field($model, 'costo')->textInput(['readonly' => true]) ?>
            </div>
            <div class="col-md-4">    
            	<?= $form->field($model, 'pagoConfirmado')->textInput(['readonly' => true]) ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <?= Html::submitButton('Confirmar', ['class' => 'btn btn-success btn-lg btn-block']) ?>
      </div>

      <?php ActiveForm::end(); ?>
