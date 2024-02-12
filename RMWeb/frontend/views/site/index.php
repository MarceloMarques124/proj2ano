<?php

use yii\helpers\Url;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron bg-success text-white text-center" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"> <!-- Adiciona box-shadow para criar contraste -->
        <h1 class="display-4">Rest Manager!</h1>
        <p class="lead">Discover and reserve tables at your favorite restaurants.</p>
    </div>

    <div class="container">
        <div class="row">
            <?php foreach ($restaurants as $restaurant) : ?>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-success"><?= Html::encode($restaurant['name']) ?></h5> <!-- Define a cor do texto como text-success -->
                            <p class="card-text"><?= Html::encode($restaurant['address']) ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="<?= Url::to(['reservation/create', 'restaurant_id' => $restaurant['id']]) ?>" class="btn btn-success btn-sm">Reserve</a>
                            <a href="<?= Url::to(['menu/index']) ?>" class="btn btn-success btn-sm">Menus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>