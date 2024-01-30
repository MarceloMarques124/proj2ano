<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Payment data';
?>

<h1><?= Html::encode($this->title) ?></h1>
<br><br>

<p>Valor da Fatura: <?= $orderPrice ?></p>
<p>Nome: <?= $user->name ?></p>
<p>Morada: <?= $user->address ?></p>
<p>Nif: <?= $user->nif ?></p>

<br><br>

<p>Numero cartao: <input type="text"></p>
<p>Validade: <input type="text"></p>
<p>Cv: <input type="text"></p>

<?php $form = ActiveForm::begin(); ?>
<?= Html::a('Pay now', ['payorder', 'id' => $orderId], ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>