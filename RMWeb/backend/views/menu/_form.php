<?php

use common\models\Menu;
use common\models\Restaurant;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Menu $model */
/** @var ActiveForm $form */
/** @var Restaurant[] $restaurants */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'restaurant_id')->dropDownList(ArrayHelper::map($restaurants, 'id', 'name'),
        ['prompt' => 'Select Restaurant'] // Optional prompt
    )->label('Select Restaurant'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
