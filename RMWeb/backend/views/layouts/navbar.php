<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php 
if (!Yii::$app->user->isGuest)  {
    # code...
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::to(['/user/index']) ?>" class="nav-link">User Management</a>
        </li>

        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">API</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <a href="<?= Url::to(['/api/restaurants']) ?>" class="nav-link">Restaurants</a>
                <a href="<?= Url::to(['/api/zones']) ?>" class="nav-link">Zones</a>
                <a href="<?= Url::to(['/api/menus']) ?>" class="nav-link">Menus</a>
                <a href="<?= Url::to(['/api/reviews']) ?>" class="nav-link">Reviews</a>
                <a href="<?= Url::to(['/api/table']) ?>" class="nav-link">Tables</a>
                <a href="<?= Url::to(['/api/orders']) ?>" class="nav-link">Orders</a>
                <!-- <a href="<?= Url::to(['/api/orders']) ?>" class="nav-link">Reservations</a>
                <a href="<?= Url::to(['/api/orderesmenus']) ?>" class="nav-link">Reservations</a>
                <a href="<?= Url::to(['/api/reservations']) ?>" class="nav-link">Reservations</a>
                <a href="<?= Url::to(['/api/userinfos']) ?>" class="nav-link">Reservations</a>
                <a href="<?= Url::to(['/api/reservations']) ?>" class="nav-link">Reservations</a> -->
                <li><?= Html::a('Sign out', ['site/logout'], ['data-method' => 'post', 'class' => 'dropdown-item']) ?></li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<?php }?>