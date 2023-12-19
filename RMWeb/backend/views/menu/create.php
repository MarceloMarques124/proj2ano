<?php

use common\models\Menu;
use common\models\Restaurant;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Menu $model */
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
