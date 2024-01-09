<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\bootstrap5\Alert;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\UserInfo $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="user-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.username',
            'name',
            'address',
            'door_number',
            'postal_code',
            'nif',
        ],
    ]) ?>

    <?php // Exiba a mensagem se existir
    if (Yii::$app->session->hasFlash('success')) {
        echo Alert::widget([
            'options' => ['class' => 'alert-success'],
            'body' => Yii::$app->session->getFlash('success'),
        ]);
    } ?>

</div>