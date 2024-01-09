<?php

use yii\bootstrap5\Html;
use common\models\UserForm;
use common\models\UserInfo;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;


/** @var yii\web\View $this */
/** @var UserForm $userForm */
/** @var yii\widgets\ActiveForm $form */
/** @var $roles */
/** @var $restaurants */

?>

<div class="user-info-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($userForm, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($userForm, 'email') ?>

    <?= $form->field($userForm, 'name')->textInput() ?>

    <?= $form->field($userForm, 'address')->textInput() ?>

    <?= $form->field($userForm, 'door_number')->textInput() ?>

    <?= $form->field($userForm, 'postal_code')->textInput() ?>

    <?= $form->field($userForm, 'nif')->textInput() ?>

    <?php
    if (\Yii::$app->user->can('admin')) {
        echo  $form->field($userForm, 'role')->dropDownList(
            array_diff_assoc(ArrayHelper::map($roles, 'name', 'name'), ['client' => 'client']),
            ['prompt' => 'Select Role'] // Optional prompt
        )->label('Select Role');
    } else {
        echo  $form->field($userForm, 'role')->dropDownList(
            array_diff_assoc(ArrayHelper::map($roles, 'name', 'name'), ['client' => 'client'], ['admin' => 'admin']),
            ['prompt' => 'Select Role'] // Optional prompt
        )->label('Select Role');
    }
    ?>

    <?php
    if (\Yii::$app->user->can('admin')) {
        $form->field($userForm, 'restaurant_id')->dropDownList(
            array_diff_assoc(ArrayHelper::map($restaurants, 'id', 'id')),
            ['prompt' => 'Select Restaurant'] // Optional prompt
        )->label('Select Restaurant');
    } else {
        $idUserLogged = Yii::$app->user->getId();
        $userInfo = UserInfo::findOne(['user_id' => $idUserLogged]);
        // Verificar se $userInfo existe antes de continuar
        if ($userInfo) {
            echo $form->field($userForm, 'restaurant_id')->dropDownList(
                [$userInfo->restaurant_id => $userInfo->restaurant_id],
                ['disabled' => true] // Opção desabilitada para que o valor não possa ser alterado
            )->label('Restaurant ID');
        }
    } ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>