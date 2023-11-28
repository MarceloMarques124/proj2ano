<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Table $model */
/** @var common\models\Zones[] $zones */


$this->title = 'Create Table';
$this->params['breadcrumbs'][] = ['label' => 'Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'zones'=> $zones
    ]) ?>

</div>
