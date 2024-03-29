<?php

use common\models\Zone;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ZoneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Zones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Zone', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'description',
            [
                'attribute' => 'restaurantName',
                'label' => 'Restaurant Name',
                'value' => function ($model) {
                    return $model->restaurant ? $model->restaurant->name : null;
                },
                'filter' => Html::activeTextInput($searchModel, 'restaurantName', ['class' => 'form-control']),
            ],
            'capacity',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Zone $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
