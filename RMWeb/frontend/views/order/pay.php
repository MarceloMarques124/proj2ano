<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Payment data';
?>

<div class="site-payment">
    <center>
        <h1 class="text-white"><?= Html::encode($this->title) ?></h1>
        <div class="payment-details">
            <p>Valor da Fatura: <?= $orderPrice ?></p>
            <p>Nome: <?= $user->name ?></p>
            <p>Morada: <?= $user->address ?></p>
            <p>Nif: <?= $user->nif ?></p>
        </div>
    </center>
    <div class="payment-form "> <!-- Adicionei a classe text-center para centralizar o conteúdo -->
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <label for="cardName">Nome do Cartão:</label>
            <input type="text" class="form-control" id="cardName" name="cardName">
        </div>
        <div class="form-group">
            <label for="cardNumber">Número do Cartão:</label>
            <input type="text" class="form-control" id="cardNumber" name="cardNumber">
        </div>
        <div class="form-group">
            <label for="expiryDate">Validade:</label>
            <input type="text" class="form-control" id="expiryDate" name="expiryDate">
        </div>
        <div class="form-group">
            <label for="cvv">CVV:</label>
            <input type="text" class="form-control" id="cvv" name="cvv">
        </div>

        <center><?= Html::a('Pay now', ['payorder', 'id' => $orderId], ['class' => 'btn btn-success btn-lg mt-3 ']) ?> </center>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<style>
    .site-payment {
        background-color: #28a745; /* Verde - bg-success */
        color: #fff; /* Branco - text-white */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .payment-details,
    .payment-form {
        margin-bottom: 20px;
    }

    .payment-form label {
        color: #fff; /* Branco - text-white */
    }
</style>

