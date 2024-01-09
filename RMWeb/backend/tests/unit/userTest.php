<?php


namespace backend\tests\Unit;

use common\models\User;
use yii\db\ActiveRecord;
use common\models\UserInfo;
use common\models\Restaurant;
use backend\tests\UnitTester;

class userValidationsTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $userId;
    protected $userInfoId;

    protected function _before()
    {
        // Criar um restaurante no _before() e armazenar o ID
        $restaurant = new Restaurant();
        $restaurant->name = 'Test Restaurant';
        $restaurant->address = 'Test';
        $restaurant->nif = 123321123;
        $restaurant->email = 'Test@rest.com';
        $restaurant->mobile_number = '321123321';
        $restaurant->save();

        // Create a user first
        $user = new User();
        $user->username = 'john_doe';
        $user->email = 'john@example.com';
        $user->setPassword('password123');
        $user->generateAuthKey();
        $user->save();

        $this->userId = $user->id;

        // Now create UserInfo
        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->name = 'John Doe';
        $userInfo->address = '123';
        $userInfo->door_number = 'Apt 456';
        $userInfo->postal_code = '1234-125';
        $userInfo->nif = 123456789;
        $userInfo->restaurant_id = $restaurant->id;
        $userInfo->save();
        $this->userInfoId = $userInfo->id;
    }

    public function testSaveValidUserInfo()
    {
        // Create a user first
        $user = new User();
        $user->username = 'valid';
        $user->email = 'valid@example.com';
        $user->setPassword('password123');
        $user->generateAuthKey();
        $this->assertTrue($user->save());

        // Now create UserInfo
        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->name = 'valid name';
        $userInfo->address = '123';
        $userInfo->door_number = 'Apt 456';
        $userInfo->postal_code = '1111-111';
        $userInfo->nif = 123123123;
        $this->assertTrue($userInfo->save());
    }

    public function testUserRelation()
    {
        $user = User::find()->where(['id' => $this->userId])->one();
    
        // Retrieve UserInfo using the relation
        $userInfo = $user->getUserInfo()->one();
    
        // Check if $userInfo is not null before accessing its properties
        if ($userInfo !== null) {
            $this->assertInstanceOf(ActiveRecord::class, $userInfo->user);
            $this->assertInstanceOf(User::class, $userInfo->user);
        } else {
            $this->fail('UserInfo not found.');
        }
    }
    

    public function testRestaurantRelation()
    {
        $user = User::find()->where(['id' => $this->userId])->one();
        // Retrieve UserInfo using the relation
        $userInfo = $user->getUserInfo()->one();

        // Ensure the restaurant relation is set correctly
        $this->assertInstanceOf(Restaurant::class, $userInfo->restaurant);
        $this->assertEquals($userInfo->restaurant_id, $userInfo->restaurant->id);
    }
}
