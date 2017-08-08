<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar Contacto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idcontacto',
            'nombre',
            'telefono',
            'movil',
            'correo',
            // 'fkuser',
            // 'st_actual:boolean',
            'fkempresa0.nombre',
            // 'enviarCorreo:boolean',
            // 'Created_by',
            // 'Updated_By',
            // 'Created_At',
            // 'Updated_At',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
