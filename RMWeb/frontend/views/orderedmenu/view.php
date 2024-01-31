<?php

use yii\helpers\Html;
use common\models\Menu;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\OrderedMenu $model */

$menu = Menu::findOne(['id' => $model->menu_id]);
$this->title = $menu->name;
$this->params['breadcrumbs'][] = ['label' => 'Ordered Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="ordered-menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $menu,
        'attributes' => [
            'name',
            'price',
        ],
    ]) ?>



</div>
