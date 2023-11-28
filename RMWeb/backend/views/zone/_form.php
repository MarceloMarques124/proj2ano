<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Restaurant;

/** @var yii\web\View $this */
/** @var common\models\Zone $model */
/** @var yii\widgets\ActiveForm $form */
/** @var $restaurantsIds */

?>

<div class="zone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'restaurant_id')->dropDownList(ArrayHelper::map($restaurants, 'id', 'name'),
        ['prompt' => 'Select Restaurant'] // Optional prompt
    )->label('Select Restaurat'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
