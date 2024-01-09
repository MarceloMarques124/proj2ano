<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Zone $model */
/** @var $restaurants */


$this->title = 'Create Zone';
$this->params['breadcrumbs'][] = ['label' => 'Zones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'restaurants' => $restaurants,
    ]) ?>

</div>
