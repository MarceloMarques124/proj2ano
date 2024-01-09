<?php

/** @var View $this */

/** @var string $content */


use yii\web\View;
use yii\bootstrap4\Nav;
use yii\bootstrap4\Html;
use common\widgets\Alert;
use frontend\assets\AppAsset;

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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

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

    <!-- Adicione as dependências do Bootstrap e jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyL8iDR8gh6Lw2jWlO8qU1P/TtJUOihfuU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js" integrity="sha384-BYKNOFkYvYr8I5gXQQeMZeUtiUqQ3kBCpKJ9YlU/4JG0diV3UZ4fQ5S9i0XNU6j" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyL8iDR8gh6Lw2jWlO8qU1P/TtJUOihfuU" crossorigin="anonymous"></script>

    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
            <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                    <img src="images/png/mainlogo.png" width="180" height="61,74">
                </a>
                <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto p-4 p-lg-0">
                        <?php
                        if (Yii::$app->user->isGuest) {
                            echo Html::a('Login', ['site/login'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);
                        } else {
                            echo Html::a('Home', ['site/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);
                            echo Html::a('Reserves', ['reservation/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']); //este ve so as realizadas
                            echo Html::a('Orders', ['order/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']); //este ve so as concluidas
                            echo Html::a('Home', ['site/index'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);
                            echo Html::a('Logout', ['site/logout'], ['data-method' => 'post', 'class' => 'nav-item nav-link']);
                        }
                        ?>
                        <?php
                        echo Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            'items' => [
                                ['label' => 'Reserves', 'items' => [
                                    ['label' => 'My reserves', 'url' => '#'],
                                    ['label' => 'Make reserves', 'url' => '#'],
                                ]],

                            ],

                        ]);
                        ?>
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
                                        <a href="" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 mb-5 animated slideInDown">Natural Food Is Always
                                            Healthy</h1>
                                        <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                        <a href="" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
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
