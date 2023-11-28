<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FoodItem $model */

$this->title = 'Create Food Item';
$this->params['breadcrumbs'][] = ['label' => 'Food Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
