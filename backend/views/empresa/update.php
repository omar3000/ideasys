<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Empresa */

$this->title = 'Update Empresa: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idempresa, 'url' => ['view', 'id' => $model->idempresa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
