<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\FoodItem $model */
/** @var yii\widgets\ActiveForm $form */
/** @var Menu[] $menus */

?>

<div class="food-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_id')->dropDownList(ArrayHelper::map($menus, 'id', 'name'),
        ['prompt' => 'Select Menu'] // Optional prompt
    )->label('Select Menu'); ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
