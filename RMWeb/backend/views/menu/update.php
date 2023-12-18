<?php

use common\models\Restaurant;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Menu $model */
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
        'restaurants' => $restaurants,
    ]) ?>

</div>