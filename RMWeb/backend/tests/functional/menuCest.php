<?php


namespace backend\tests\Functional;

use common\models\User;
use common\fixtures\UserFixture;
use backend\tests\FunctionalTester;


class menuCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],

        ];
    }
    public function _before(FunctionalTester $I)
    {
        $authManager = \Yii::$app->authManager;
        $authManager->assign($authManager->getRole('admin'), User::findOne(['username' => 'erau']));
        $I->amOnPage('site/login');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->see('Sign in');
        $I->submitForm('#login-form', ['LoginForm[username]' => 'test.test', 'LoginForm[password]' => 'Test1234']);
        $I->see('ABC');
    }
}
