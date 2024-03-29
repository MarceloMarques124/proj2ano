<?php

use common\models\Reservation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ReservationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'reservation', // Adicione esta linha
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>


</div>