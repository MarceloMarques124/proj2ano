<?php

use common\models\FoodItem;
use common\models\Menu;
use common\models\Restaurant;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Menu $model */
/** @var ActiveForm $form */
/** @var FoodItem $foodItemModel */
/** @var ActiveDataProvider $dataProvider */
/** @var Restaurant[] $restaurants */
?>

<div class="menu-form">


    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'restaurant_id')->dropDownList(ArrayHelper::map($restaurants, 'id', 'name'),
                ['prompt' => 'Select Restaurant']
            )->label('Select Restaurant'); ?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-4">
            <?= $this->render('../food-item/index', [
                'dataProvider' => $dataProvider
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $this->render('../food-item/_form', [
                'model' => $foodItemModel
            ]) ?>
        </div>
    </div>


    <div class="form-group">
    </div>

    <div class="form-group">
        <?= $model->id ? Html::a('Add Items to Menu', ['food-item/index'], ['class' => 'btn btn-success']) : '' ?>
    </div>


</div>
