<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OrderedMenu $model */

$this->title = 'Create Ordered Menu';
$this->params['breadcrumbs'][] = ['label' => 'Ordered Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordered-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
