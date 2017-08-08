<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\proyecto */

$this->title = 'Update Proyecto: ' . $model->idproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproyecto, 'url' => ['view', 'id' => $model->idproyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modal-header-primary">
   <?=Html::encode($this->title) ?>
</div>
<br/>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
