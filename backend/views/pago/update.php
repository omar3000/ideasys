<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pago */

$this->title = 'Actualizar Pago: ' . $model->idpago;
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>
<?= $this->render('_form', [
    'model' => $model,
    'empresas' => $empresas,
]) ?>
