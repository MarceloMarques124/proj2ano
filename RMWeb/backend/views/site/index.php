<?php

use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Order;
use yii\grid\ActionColumn;

$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $reservasNumber,
                'text' => 'Reserves for today',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $ordersNumber,
                'text' => 'Total orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $ordersPending,
                'text' => 'Payment orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $reviewNumbers,
                'text' => 'Total reviews my restaurant',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $review4Stars,
                'text' => 'Total reviews 4 stars my restaurant',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '44',
                'text' => 'User Registrations',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>
    <h1>Reservations today:</h1>
    <?php if ($orderDataProvider->getTotalCount() > 0){?>
    <?= GridView::widget([
        'dataProvider' => $orderDataProvider,
        'columns' => [
            'tables_number',
            'user.username',
            'date_time',
            'people_number',
            'remarks:ntext',
            'restaurant.name',
            'zone.name',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'reservation', // Adicione esta linha
                'template' => '{view}',
            ],
        ],
    ]); ?>
    <?php }else{echo "No reservations for today";}?>
</div>