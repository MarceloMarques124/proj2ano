<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Zone $model */
/** @var $restaurants */


$this->title = 'Update Zone: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Zones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zone-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'restaurants' => $restaurants,
    ]) ?>

</div>
