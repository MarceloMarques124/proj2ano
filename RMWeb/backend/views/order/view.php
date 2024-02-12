<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1>Order info:</h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.username',
            'restaurant.name',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 2, ',', ' ') . ' €';
                },
            ],
            'state',
        ],
    ]) ?>

    <h1>Orderer menus:</h1>

    <?= GridView::widget([
        'dataProvider' => $orderedMenusDataProvider,
        //'filterModel' => $orderedMenuSearch,
        'columns' => [
            'menu.name',
            'quantity',
        ],
    ]); ?>

</div>