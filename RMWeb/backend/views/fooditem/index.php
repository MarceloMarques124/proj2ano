<?php

use common\models\FoodItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\FoodItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Food Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Food Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'menuName',
                'label' => 'Menu Name',
                'value' => function ($model) {
                    return $model->menu ? $model->menu->name : null;
                },
                'filter' => Html::activeTextInput($searchModel, 'menuName', ['class' => 'form-control']),
            ],
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 2, ',', ' ') . ' €';
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FoodItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
