<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pago */

$this->title = 'Elimninar pago: #'$model->idpago;
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-eye-open"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>
<div class="modal-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idpago',
            'fkservicio',
            'fkservicio0.problema:html',
            'costo',
            'descripcion:html',
            'Sestatus',
            'observacion',
        ],
    ]) ?>

</div>
<div class="modal-footer">
    <span class="btn btn-success modalButton" value="../pago/delete/<?=($model->idpago)?>">Confirmar</span>
</div>