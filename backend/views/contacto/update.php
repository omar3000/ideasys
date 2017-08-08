<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contacto */

$this->title = 'Actualizar Contacto: ' . $model->idcontacto;
$this->params['breadcrumbs'][] = ['label' => 'empresa', 'url' => ['empresa/view/' . $model->fkempresa  . '/']];

$this->params['breadcrumbs'][] = 'Actualizar Contacto';
?>
<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>
<?= $this->render('_form', [
    'model' => $model,
    'usuarios' => $usuarios,
    'empresas' => $empresas,
]) ?>

