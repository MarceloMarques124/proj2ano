<?php


namespace frontend\tests\Functional;

use common\models\User;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class reserveCest
{

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $authManager = \Yii::$app->authManager;
        $authManager->assign($authManager->getRole('client'), User::findOne(['username' => 'erau'])->id);
        $I->amOnPage('reservation/create');
    }

    public function createReserve(FunctionalTester $I)
    {
        //Realizar login e adicionar artigo ao carrinho
        $I->amLoggedInAs(User::findByUsername('erau'));
        $I->see('Create Reservation');
        $I->submitForm('form#login', ['name' => 'john', 'password' => '123456']);
    }
}
