<?php

 
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Servicio;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\proyecto */

$this->title = 'Nuevo Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

