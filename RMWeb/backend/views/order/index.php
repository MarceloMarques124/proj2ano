<?php

use common\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'userName',
                'label' => 'User Name',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : null;
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
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'order', // Adicione esta linha
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>