<?php

use common\models\UserInfo;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\UserInfoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'userName',
                'label' => 'Username',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : null;
                },
                'filter' => Html::activeTextInput($searchModel, 'userName', ['class' => 'form-control']),
            ],
            'name',
            'address',
            'door_number',
            'postal_code',
            'nif',
            [
                'attribute' => 'userMail',
                'label' => 'Email',
                'value' => function ($model) {
                    return $model->user ? $model->user->email : null;
                },
                'filter' => Html::activeTextInput($searchModel, 'userMail', ['class' => 'form-control']),
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}  {delete} {activate} {desactivate}',
                'buttons' => [
                    'activate' => function ($url, $model, $key) {
                        if ($model->user->status == 9) {
                            return Html::a(
                                '<span class="fas fa-check"></span>',
                                ['activate', 'id' => $model->id],
                                [
                                    'title' => 'Activate',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to activate this user?',
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        }
                    },

                    'desactivate' => function ($url, $model, $key) {
                        if ($model->user->status == 10) {
                            return Html::a(
                                '<span class="fas fa-times"></span>',
                                ['desactivate', 'id' => $model->id],
                                [
                                    'title' => 'Desactivate',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to desactivate this user?',
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        }
                    },
                ],
            ],
        ],
    ]); ?>


</div>