<?php

use common\models\Restaurant;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Menu $model */
/** @var Restaurant[] $restaurants */

$this->title = 'Create Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'restaurants' => $restaurants,
    ]) ?>

</div>
