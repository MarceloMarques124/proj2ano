<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;
use hail812\adminlte\widgets\Menu;

?>
<?php
if (!Yii::$app->user->isGuest) {
    # code...

?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <a href="<?= Url::to(['/site/index']) ?>" class="brand-link">
            <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Restaurant Manager</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= Yii::$app->user->getIdentity()->username; ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <?php
                echo Menu::widget([
                    'items' => [

                        ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                        ['label' => 'Yii2 PROVIDED', 'header' => true],
                        ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-auth_assignmentalt', 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                        ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                        [
                            'label' => 'Restaurants',
                            'items' => [
                                ['label' => 'Create', 'url' => ['restaurant/create'], 'iconStyle' => 'far'],
                                ['label' => 'View all', 'url' => ['restaurant/index'], 'iconStyle' => 'far'],
                            ]
                        ],
                        [
                            'label' => 'Zones',
                            'items' => [
                                ['label' => 'Create', 'url' => ['zone/create'], 'iconStyle' => 'far'],
                                ['label' => 'View all', 'url' => ['zone/index'], 'iconStyle' => 'far'],
                            ]
                        ],
                        [
                            'label' => 'Tables',
                            'items' => [
                                ['label' => 'Create', 'url' => ['table/create'], 'iconStyle' => 'far'],
                                ['label' => 'View all', 'url' => ['table/index'], 'iconStyle' => 'far'],
                            ]
                        ],
                        [
                            'label' => 'Menus', 'icon' => 'fa-solid fa-utensils',
                            'items' => [
                                ['label' => 'Create', 'url' => ['menu/create'], 'iconStyle' => 'far'],
                                ['label' => 'View all', 'url' => ['menu/index'], 'iconStyle' => 'far'],
                            ]
                        ],
                        // [
                        //     'label' => 'ITEMS', 'icon' => 'fa-solid fa-utensils',
                        //     'items' => [
                        //         ['label' => 'Create', 'url' => ['item/create'], 'iconStyle' => 'far'],
                        //         ['label' => 'View all', 'url' => ['FoodItem/index'], 'iconStyle' => 'far'],
                        //     ]
                        // ],
                    ],

                ]);

                ?>
                <?= Html::a('Sign out', ['site/logout'], ['data-method' => 'post', 'class' => 'dropdown-item']) ?>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
<?php } ?>