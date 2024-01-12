<?php

namespace backend\tests\functional;

use Yii;
use common\models\User;
use common\fixtures\UserFixture;
use backend\tests\FunctionalTester;

/**
 * Class LoginCest
 */
class LoginCest
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

    /**
     * @param FunctionalTester $I
     */
    protected $userId;

    public function _before(FunctionalTester $I)
    {
        $user = new User();
        $user->username = 'test';
        $user->auth_key = 'O87GkY3_UfmMHYkyezZ7QLfmkKNsllzT';
        $user->password_hash = Yii::$app->security->generatePasswordHash('Test1234');
        $user->email = 'test@mail.com';
        $user->created_at = '1548675330';
        $user->updated_at = '1548675330';
        $user->status = 10;
        $user->verification_token = '4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330';
        $user->save();
        $this->userId = $user->id;

        $authManager = \Yii::$app->authManager;
        $adminRole = $authManager->createRole('admin');
        $authManager->add($adminRole);
        $authManager->assign($adminRole, $user->id);
    }

    public function loginUser(FunctionalTester $I)
    {
        $userLogged = User::findOne(['username' => 'test']);
        if($userLogged){
            $I->amOnRoute('/menu/create');
            $I->click('AA');
        }
    }
}
