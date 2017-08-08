<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pago */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Actualizar Pago: ' . $model->idpago;
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
 <?php $form = ActiveForm::begin(); ?>

<div class="modal-header modal-header-success">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h1 style="color: white"><i class="glyphicon glyphicon-usd"></i><?=(' Realizar un pago a #pago:' .$model->idpago)?></h1>
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
            	'observacion:html'
        	],
    	]) ?>
    </div>

    <div class="row">
        <div class="col-md-4">    
            <?= $form->field($model, 'pagoPendiente')->textInput() ?>
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
    <?= Html::submitButton('Confirmar Pago', ['class' => 'btn btn-success btn-lg btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>
