<?php

/** @var View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap"
              rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
            <!--<div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
                <div class="col-lg-6 px-5 text-start">
                </div>
                <div class="col-lg-6 px-5 text-end">
                    <small>Follow us:</small>
                    <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
                    <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>-->

            <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                    <img src="images/png/mainlogo.png" width="180" height="61,74">
                </a>
                <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto p-4 p-lg-0">
                        <?php /*= Html::a('Contact', ['site/contact'], ['data-method' => 'post', 'class' => 'nav-item nav-link'])*/ ?><!--
                    <?php /*= Html::a('Contact', ['site/contact'], ['data-method' => 'post', 'class' => 'nav-item nav-link'])*/ ?>
                    <?php /*= Html::a('Contact', ['site/contact'], ['data-method' => 'post', 'class' => 'nav-item nav-link'])*/ ?>
                    --><?php /*= Html::a('Contact', ['site/contact'], ['data-method' => 'post', 'class' => 'nav-item nav-link'])*/ ?>

                        <?php
                        if (Yii::$app->user->isGuest) {
                            echo Html::a('Login', ['site/login'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);
                        } else {
                            echo Html::a('Home', ['site/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);
                            echo Html::a('Reserves', ['reservations/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']); //este ve so as realizadas
                            echo Html::a('Orders', ['orders/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']); //este ve so as concluidas
                            echo Html::a('Home', ['site/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);
                            echo Html::a('Logout', ['site/logout'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);

                        }
                        ?>

                        <!--<div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="blog.html" class="dropdown-item">Blog Grid</a>
                                <a href="feature.html" class="dropdown-item">Our Features</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>-->
                    </div>
                    <div class="d-none d-lg-flex ms-2">
                        <?php /*= Html::a('', ['site/login'], ['data-method' => 'post', 'class' => 'nav-item nav-link fa fa-user text-body'])*/ ?>
                        <?php /*= Html::a('', ['site/about'], ['data-method' => 'post', 'class' => 'nav-item nav-link fas fa-sign-out-alt'])*/ ?>

                        <!--
                        <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                            <small class="fa fa-user text-body"></small>
                        </a>
                        <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                            <small class="fa fa-shopping-bag text-body"></small>
                        </a>-->
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main role="main" class="flex-shrink-0">
        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 mb-5 animated slideInDown">Organic Food Is Good For
                                            Health</h1>
                                        <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                        <a href=""
                                           class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 mb-5 animated slideInDown">Natural Food Is Always
                                            Healthy</h1>
                                        <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                        <a href=""
                                           class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div>
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-dark mb-4">David Domingues</h4>
                    <p><i class="fa fa-envelope me-3"></i>2220897@my.ipleiria.pt</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-dark mb-4">João Monteiro</h4>
                    <p><i class="fa fa-envelope me-3"></i>2220892@my.ipleiria.pt</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-dark mb-4">Marcelo Marques</h4>
                    <p><i class="fa fa-envelope me-3"></i>2200428@my.ipleiria.pt</p>
                </div>

            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">RestManager</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
