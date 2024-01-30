<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OrderedMenu $model */

$this->title = 'Update Ordered Menu: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ordered Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ordered-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
