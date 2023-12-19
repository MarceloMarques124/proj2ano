<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FoodItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Food Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-item-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'price',
            [
                'class' => ActionColumn::className(),
                'template' => '{update-food-item} {delete-food-item}',
                'buttons' => [
                    'update-food-item' => function ($url, $model, $key) {
                        print_r($url);
                        return Html::a('Update', $url, ['class' => 'btn btn-primary']);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
