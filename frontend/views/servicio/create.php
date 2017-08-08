<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Servicio */
/* @var $form yii\widgets\ActiveForm */


$this->title = 'Solicitar Servicio';
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal-header-primary">
    <?=Html::encode($this->title) ?>
</div>
<br/>

<?php $form = ActiveForm::begin(); ?>

<div class="modal-body">

    <div class="row">
         <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <p class="h2"> El costo del servicio es $<?= $costo ?>  MXN </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'autorizo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
   <div class="row">
        <div class="col-md-12">
    		<?= $form->field($model, 'problema')->widget(TinyMce::className(), [
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
	<?= Html::submitButton( 'Crear Servicio' , ['class' => 'btn btn-success btn-lg btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>
