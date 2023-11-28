<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Restaurant $model */

$this->title = 'Create Restaurants';
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>