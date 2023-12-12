<?php

use common\models\Reservation;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?php /*= Html::a('Create Reservation', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>-->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'table.id',
            'user_id', //pedir nome de restaurantwe
            'date_time',
            'people_number',
            // 'remarks',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Reservation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
