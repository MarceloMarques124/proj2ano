<?php

use yii\helpers\Html;
use common\models\Menu;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\OrderedMenu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ordered-menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $menu = Menu::findOne(['id' =>  $model->menu_id]); ?>
    <?= $form->field($model, 'menu_id')->textInput(['value' => $menu->name, 'disabled' => true])
          ->label('Menu Name') ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'order_id')->textInput(['disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
