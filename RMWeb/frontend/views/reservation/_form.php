<?php

use yii\helpers\Html;
use common\models\Zone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var common\models\Reservation $model */
/** @var yii\widgets\ActiveForm $form */

/** @var common\models\Zone[] $zonas */

?>

<div class="reservation-form">

    <?php $form = ActiveForm::begin(['id' => 'formReserve']); ?>


    <?= $form->field($model, 'date_time')->widget(DateTimePicker::class, [
        'options' => ['placeholder' => 'Select date and time ...'],
        'bsVersion' => '5',
        'language' => 'pt', // Define o idioma para português
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:ii', // Formato com horas em 12h (hh) e minutos (ii)
            'todayHighlight' => true,
            'autoclose' => true,
            'startView' => 'month',
            'minView' => 'hour', // Apenas exibe até horas
            'maxView' => 'decade',
            'hoursDisabled' => '0,1,2,3,4,5,6,7,8,9,10,11,23', // Desabilita as horas fora do intervalo
            'minuteStep' => 15, // Arredonda para o próximo intervalo de 30 minutos
            'startDate' => date('Y-m-d H:00', strtotime('+1 hour')), // Define a hora inicial para uma hora após a hora atual com minutos como "00"
        ],

    ]); ?>
    <?= $form->field($model, 'zone_id')->dropDownList(ArrayHelper::map($zonas, 'id', 'name'), ['prompt' => 'Select Zone']); ?>

    <?= $form->field($model, 'people_number')->textInput() ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name'=>'btnSave']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>