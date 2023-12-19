<?php

use common\models\Table;
use common\models\User;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Reservation $model */
/** @var yii\widgets\ActiveForm $form */
/** @var User[] $users */
/** @var Table[] $tables */
?>

<div class="reservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'table_id')->dropDownList(ArrayHelper::map($tables, 'id', 'id'),
        ['prompt' => 'Select a Table'] // Optional prompt
    )->label('Select Table'); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map($users, 'id', 'username'),
        ['prompt' => 'Select a User'] // Optional prompt
    )->label('Select User'); ?>

    <?= $form->field($model, 'date_time')->textInput() ?>


    <?= $form->field($model, 'people_number')->textInput() ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
