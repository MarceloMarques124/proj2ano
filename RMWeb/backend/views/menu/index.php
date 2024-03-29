<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use Bluerhinos\phpMQTT;
use common\models\Menu;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var backend\models\MenuSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 2, ',', ' ') . ' €';
                },
            ],
            [
                'attribute' => 'restaurantName',
                'label' => 'Restaurant Name',
                'value' => function ($model) {
                    return $model->restaurant ? $model->restaurant->name : null;
                },
                'filter' => Html::activeTextInput($searchModel, 'restaurantName', ['class' => 'form-control']),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Menu $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>