<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Servicio */

$this->title = "#servicio: " .$model->idservicio;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
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
            'idservicio',
            'fkuserSolicitante.username',
            'fecha_hr_solicitada',
            'autorizo',
            'problema:Html',
            'fkuserAtendio.username',
            'fkusuarioAtendio2.username',
            'fecha_hr_inicio',
            'fecha_hr_fin',
            'solucion:Html',
        ],
    ]) ?>

</div>
