<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var SignupForm $model */

use frontend\models\SignupForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'address')->textInput() ?>

            <?= $form->field($model, 'door_number')->textInput() ?>

            <?= $form->field($model, 'postal_code')->textInput() ?>

            <?= $form->field($model, 'nif')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
