<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contacto */

$this->title =  $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'empresa', 'url' => ['empresa/view/' . $model->fkempresa  . '/']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="modal-header-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 style="color: white"><i class="glyphicon glyphicon-pencil"></i><?=Html::encode($this->title) ?></h1>
</div>
<br/>
<div class="modal-body">
    
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'attributes' => [
            'nombre',
            'telefono',
            'movil',
            'correo',
            'fkuser0.username',
            'fkempresa0.nombre',
        ],
    ]) ?>

</div>


