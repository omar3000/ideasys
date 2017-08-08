<?php
use yii\helpers\Html;
use common\models\User;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <?=(Yii::$app->user->can(User::USUARIO_OPERADOR) || Yii::$app->user->can(User::USUARIO_PRODUCCION))? 
        '<div class="col-md-4">
            <div class="thumbnail">
                <img src="uploads/servicio.jpg" alt="...">
                <div class="caption">
                    <h3>Servicios</h3>'.
                    Html::a('Entrar', ['/servicio/index'], ['class' => 'btn btn-primary']) .
                '</div>
            </div>
        </div>' : ""; ?>

        <?=(Yii::$app->user->can(User::USUARIO_PAGOS))? 
        '<div class="col-md-4">
            <div class="thumbnail">
                <img src="uploads/pago.jpg" alt="...">
                <div class="caption">
                    <h3>Pagos</h3>'.
                    Html::a('Entrar', ['/pago/index'], ['class' => 'btn btn-primary']) .
                '</div>
            </div>
        </div>' : ""; ?>
    </div>
</div>