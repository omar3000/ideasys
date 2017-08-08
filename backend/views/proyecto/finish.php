<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\proyecto */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Terminar Proyecto: ' . $model->idproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproyecto, 'url' => ['view', 'id' => $model->idproyecto]];
$this->params['breadcrumbs'][] = 'Finish';

?>

<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>

<?php $form = ActiveForm::begin(); ?>

<div class="modal-body">

	<?= $form->field($model, 'nombre')->textInput(['readonly' => true]) ?>

	<div class="form-group">
		<?= $model->descripcion ?>
	</div>

	<div class="form-group">
        <div class="col-md-2">
            <?= $form->field($model, 'fecha_hr_entregado')->widget(DatePicker::classname(), [
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
</div>
<div class="modal-footer">
    <?= Html::submitButton('Terminar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
