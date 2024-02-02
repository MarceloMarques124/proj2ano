<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Menu;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Order $model */
/** @var yii\data\ActiveDataProvider $orderedMenusDataProvider */


$this->title = 'Order:';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->state == 'payment') { ?>
            <?= Html::a('Pay', ['pay', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.username',
            'restaurant.name',
            'price',
            'state',
        ],
    ]) ?>
<h1><?= Html::encode("Ordered Menus:") ?></h1>
    <?php
    if ($model->state == 'payment') {
    ?>
        <?= GridView::widget([

            'dataProvider' => $orderedMenusDataProvider,
            //'filterModel' => $orderedMenuSearch,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'menu.name',
                'quantity',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'controller' => 'orderedmenu', // Adicione esta linha
                    'template' => '{view} {update} {delete}',
                ],
            ],
        ]); ?>

    <?php } else { ?>
        <?= GridView::widget([

            'dataProvider' => $orderedMenusDataProvider,
            //'filterModel' => $orderedMenuSearch,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'menu.name',
                'quantity',
            ],
        ]); ?>
    <?php } ?>
</div>