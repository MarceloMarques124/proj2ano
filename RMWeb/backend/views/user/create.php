<?php

use common\models\UserForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var UserForm $userForm */
/** @var $roles */
/** @var $restaurants */


$this->title = 'Create User Info';
$this->params['breadcrumbs'][] = ['label' => 'User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'userForm' => $userForm,
        'roles' => $roles,
        'restaurants' => $restaurants,
    ]) ?>

</div>
