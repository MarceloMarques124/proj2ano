<?php

use yii\web\View;
use yii\helpers\Html;
use common\models\Menu;
use common\models\UserInfo;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Restaurant;

/** @var View $this */
/** @var Menu $model */
/** @var ActiveForm $form */
/** @var Restaurant[] $restaurants */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?php
    if (\Yii::$app->user->can('admin')) {
        echo $form->field($model, 'restaurant_id')->dropDownList(
            ArrayHelper::map($restaurants, 'id', 'name'),
            ['prompt' => 'Select Restaurant'] // Optional prompt
        )->label('Select Restaurant');
    } else {
        $idUserLogged = Yii::$app->user->getId();
        $userInfo = UserInfo::findOne(['user_id' => $idUserLogged]);
        // Verificar se $userInfo existe antes de continuar
        if ($userInfo) {
            echo $form->field($model, 'restaurant_id')->dropDownList(
                [$userInfo->restaurant_id => $userInfo->restaurant_id],
                ['options' => [$userInfo->restaurant_id => ['selected' => true]]] // Desabilitado e opção selecionada
            )->label('Restaurant ID');
        }
    }
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>