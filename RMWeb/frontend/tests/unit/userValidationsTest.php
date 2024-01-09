<?php


namespace frontend\tests\Unit;

use common\models\User;
use common\models\UserInfo;
use frontend\tests\UnitTester;

class userValidationsTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function testSaveValidUserInfo()
    {
        // Create a user first
        $user = new User();
        $user->username = 'john_doe';
        $user->email = 'john@example.com';
        $user->setPassword('password123');
        $user->generateAuthKey();
        $user->save();

        // Now create UserInfo
        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->name = 'John Doe';
        $userInfo->address = '123';
        $userInfo->door_number = 'Apt 456';
        $userInfo->postal_code = '1234-125';
        $userInfo->nif = 123456789;

        $this->assertTrue($userInfo->save());
    }

    
}
