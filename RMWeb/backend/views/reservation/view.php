<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Reservation $model */

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reservation-view">

    <h1>Reserve:</h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tables_number',
            'user.username',
            'date_time',
            'people_number',
            'remarks:ntext',
            'restaurant.name',
            'zone.name',
        ],
    ]) ?>

</div>