<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">   
			<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
		</div>
	</div>	

	<div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
