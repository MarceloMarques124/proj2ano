<?php

use common\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => ['class' => 'grid-view-container'], // Adiciona uma classe CSS personalizada
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'userName',
            'label' => 'User Name',
            'value' => function ($model) {
                return $model->restaurant ? $model->restaurant->name : null;
            },
            'filter' => Html::activeTextInput($searchModel, 'userName', ['class' => 'form-control']),
        ],
        [
            'attribute' => 'restaurantName',
            'label' => 'Restaurant Name',
            'value' => function ($model) {
                return $model->restaurant ? $model->restaurant->name : null;
            },
            'filter' => Html::activeTextInput($searchModel, 'restaurantName', ['class' => 'form-control']),
        ],
        [
            'attribute' => 'price',
            'value' => function ($model) {
                return number_format($model->price, 2, ',', ' ') . ' €';
            },
        ],
        'state',
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
            'template' => '{view} {delete}',
            'visibleButtons' => [
                'delete' => function ($model) {
                    return $model->state === 'payment';
                },
            ],
        ],
    ],
]); ?>
<style>
    .grid-view-container {
        background-color: #28a745; /* Verde - bg-success */
        color: #fff; /* Branco - text-white */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
</style>



</div>
