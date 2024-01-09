<?php

use yii\helpers\Html;
use common\models\UserInfo;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Zone $model */
/** @var yii\widgets\ActiveForm $form */
/** @var $restaurants */

?>

<div class="zone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php $idUserLogged = Yii::$app->user->getId();
    $userInfo = UserInfo::findOne(['user_id' => $idUserLogged]);
    // Verificar se $userInfo existe antes de continuar
    if ($userInfo) {
        echo $form->field($model, 'restaurant_id')->dropDownList(
            [$userInfo->restaurant_id => $userInfo->restaurant_id],
            ['disabled' => true] // Opção desabilitada para que o valor não possa ser alterado
        )->label('Restaurant ID');
    } ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>