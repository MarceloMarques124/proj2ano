<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use common\models\FoodItem;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Menu $model */
/** @var yii\data\ActiveDataProvider $foodItemsDataProvider */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 2, ',', ' ') . ' €';
                },
            ],
            'restaurant.name',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $foodItemsDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'price',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'fooditem', // Adicione esta linha
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
    <p>

        <?= Html::a('Add Item', ['fooditem/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

</div>