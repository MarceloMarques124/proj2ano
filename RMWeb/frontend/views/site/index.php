<?php

use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
            <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach ($restaurants as $restaurant) : ?>
                <div class="col-lg-4">
                    <?= $restaurant['name']; ?>
                    <br>
                    <?= $restaurant['address']; ?>
                    <br>
                    <button id="btnReserve" type="button" style="margin-bottom: 20px;"><a href="<?= Url::to(['reservation/create', 'restaurant_id' => $restaurant['id']]) ?>" class="nav-link">Reserve</a></button>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>