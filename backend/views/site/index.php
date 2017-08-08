<?php
use yii\helpers\Html;
use common\models\User;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <?=(Yii::$app->user->can(User::USUARIO_ISOPORTE))?
        '<div class="col-md-4">
            <div class="thumbnail">
                <img src="uploads/servicio.jpg" alt="...">
                <div class="caption">
                    <h3>Servicios</h3>'.
                    Html::a('Entrar', ['/servicio/index'], ['class' => 'btn btn-primary']). 
                '</div>
            </div>
        </div>' : ""; ?>

        <?=(Yii::$app->user->can(User::USUARIO_ISOPORTE))?
        '<div class="col-md-4">
            <div class="thumbnail">
                <img src="uploads/proyecto.jpg" alt="...">
                <div class="caption">
                    <h3>Proyectos</h3>' .
                     Html::a('Entrar', ['/proyecto/index'], ['class' => 'btn btn-primary']).
                '</div>
            </div>
        </div>' :""; ?>

        <?=(Yii::$app->user->can(User::USUARIO_ADMINISTRATIVO))? 
        '<div class="col-md-4">
            <div class="thumbnail">
                <img src="uploads/pago.jpg" alt="...">
                <div class="caption">
                    <h3>Pagos</h3>'.
                    Html::a('Entrar', ['/pago/index?id=0'], ['class' => 'btn btn-primary']) .
                '</div>
            </div>
        </div>' :""; ?>

        <div class="col-md-4">
            <div class="thumbnail">
                <img src="uploads/empresas.jpg" alt="...">
                <div class="caption">
                    <h3>Empresas</h3>
                    <?= Html::a('Entrar', ['/empresa/index'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>


    </div>

</div>
