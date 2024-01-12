<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\prestacao $model */

$this->title = 'Create Prestacao';
$this->params['breadcrumbs'][] = ['label' => 'Prestacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
