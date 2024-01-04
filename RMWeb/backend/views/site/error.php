<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $exception Exception */

$this->title = 'Forbidden (#403)';
?>

<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        Você não tem permissão para acessar esta página.
    </div>

    <p>
        Por favor, volte para a página anterior ou vá para a página inicial.
    </p>
    <?php if (!Yii::$app->user->isGuest) { ?>
        <?= Html::a('Voltar à Página Anterior', Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'btn btn-default']) ?>
    <?php } else { ?>
        <?= Html::a('Ir para o Login', ['site/login'], ['class' => 'btn btn-primary']) ?>
    <?php } ?>
</div>