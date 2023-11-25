<?php

use common\models\UserForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var UserForm $userForm */
/** @var yii\widgets\ActiveForm $form */
/** @var $roles */
?>

<div class="user-info-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($userForm, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($userForm, 'email') ?>

    <?= $form->field($userForm, 'password')->passwordInput() ?>

    <?= $form->field($userForm, 'name')->textInput() ?>

    <?= $form->field($userForm, 'address')->textInput() ?>

    <?= $form->field($userForm, 'door_number')->textInput() ?>

    <?= $form->field($userForm, 'postal_code')->textInput() ?>

    <?= $form->field($userForm, 'nif')->textInput() ?>

    <?= $form->field($userForm, 'role')->dropDownList(ArrayHelper::map($roles, 'name', 'name'),
        ['prompt' => 'Select Role'] // Optional prompt
    )->label('Select Role'); ?>

    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
