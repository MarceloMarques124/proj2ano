<?php
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
                'text' => 'Orders today',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $ordersPending,
                'text' => 'Pending orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $reviewNumbers,
                'text' => 'Pending orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $review4Stars,
                'text' => 'Pending orders',
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
</div>