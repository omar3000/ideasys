<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model common\models\Servicio */

$this->title = 'Iniciar Servicio: ' . $model->idservicio;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idservicio, 'url' => ['view', 'id' => $model->idservicio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>
<?= $this->render('_form', [
    'model' => $model,
	'estatus' => $estatus, 
	'usuarios' => $usuarios,
]) ?>
