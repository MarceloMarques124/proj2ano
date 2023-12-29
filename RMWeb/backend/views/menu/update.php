<?php

use common\models\FoodItem;
use common\models\Menu;
use common\models\Restaurant;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Menu $model */
/** @var FoodItem $foodItemModel */
/** @var ActiveDataProvider $dataProvider */
/** @var ActiveDataProvider $allFoodItems */
/** @var Restaurant[] $restaurants */

$this->title = 'Update Menu: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'foodItemModel' => $foodItemModel,
        'restaurants' => $restaurants,
        'dataProvider' => $dataProvider,
        'allFoodItems' => $allFoodItems,
    ]) ?>

</div>
