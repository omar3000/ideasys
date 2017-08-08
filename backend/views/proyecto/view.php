<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\proyecto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
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
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'attributes' => [
            'nombre',
            'descripcion:html',
            'fecha_entrega:date',
            'st_indusoft:boolean',
            'st_plc:boolean',
            'st_rx3:boolean',
            'st_probado:boolean',
            'st_entregado:boolean',
            'st_dar_prioridad:boolean',
            'fecha_hr_entregado',
        ],
    ]) ?>

</div>
