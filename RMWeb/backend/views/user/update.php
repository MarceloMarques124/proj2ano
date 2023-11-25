<?php

use common\models\UserForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var UserForm $userForm */
/** @var  $roles */

$this->title = 'Update User Info: ' . $userForm->name;
$this->params['breadcrumbs'][] = ['label' => 'User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $userForm->name, 'url' => ['view', 'id' => $userForm->userId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'userForm' => $userForm,
        'roles' => $roles
    ]) ?>

</div>
