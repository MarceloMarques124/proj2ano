<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Reservation $model */
/** @var common\models\Table[] $restaurants */
/** @var common\models\User[] $users */



$this->title = 'Create Reservation';
$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tables' => $tables,
        'users' => $users,
    ]) ?>

</div>
