<?php

use common\models\Reservation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\ReservationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => ['class' => 'grid-view-container'], // Adiciona uma classe CSS personalizada
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'tables_number',
        [
            'attribute' => 'userName',
            'label' => 'User Name',
            'value' => function ($model) {
                return $model->user ? $model->user->username : null;
            },
            'filter' => Html::activeTextInput($searchModel, 'userName', ['class' => 'form-control']),
        ],
        'date_time',
        'people_number',
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Reservation $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>

</div>

<style>
    .grid-view-container {
        background-color: #28a745; /* Verde - bg-success */
        color: #fff; /* Branco - text-white */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
</style>