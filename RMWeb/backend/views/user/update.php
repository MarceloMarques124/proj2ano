<?php

use common\models\UserForm;

/** @var yii\web\View $this */
/** @var UserForm $userForm */
/** @var  $roles */
/** @var  $restaurants */


$this->title = 'Update User Info: ' . $userForm->name;
$this->params['breadcrumbs'][] = ['label' => 'User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $userForm->name, 'url' => ['view', 'id' => $userForm->userId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-info-update">


    <?= $this->render('_form', [
        'userForm' => $userForm,
        'roles' => $roles,
        'restaurants' => $restaurants,
    ]) ?>

</div>
