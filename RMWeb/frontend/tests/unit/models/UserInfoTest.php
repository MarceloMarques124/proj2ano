<?php

namespace tests\common\models;

use common\models\UserInfo;
use common\models\Restaurant;
use common\models\User;
use yii\base\InvalidConfigException;

class UserInfoTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        UserInfo::deleteAll();
    }

    protected function _after()
    {
        UserInfo::deleteAll();
    }

    public function testCreateValidUserInfo()
    {
        $userInfo = new UserInfo([
            'user_id' => 1,
            'name' => 'John Doe',
            'address' => '123 Test St',
            'door_number' => 'Apt 456',
            'postal_code' => '12345',
            'nif' => 123444449,
            'restaurant_id' => 1,
        ]);

        $this->assertTrue($userInfo->save());
    }

    public function testRequiredFields()
    {
        $userInfo = new UserInfo();

        // Tentar salvar sem preencher campos obrigatórios
        $this->assertFalse($userInfo->save());

        // Verificar se as mensagens de erro esperadas estão presentes
        $this->assertArrayHasKey('user_id', $userInfo->errors);
        $this->assertArrayHasKey('name', $userInfo->errors);
    }

    public function testUniqueUserId()
    {
        // Criar um UserInfo com user_id existente
        $existingUserInfo = new UserInfo([
            'user_id' => 1,
            'name' => 'Existing User',
        ]);
        $existingUserInfo->save();

        $userInfo = new UserInfo([
            'user_id' => 1, // Mesmo ID
            'name' => 'John Doe',
        ]);

        // Tentar salvar o UserInfo com user_id já existente
        $this->assertFalse($userInfo->save());
        $this->assertArrayHasKey('user_id', $userInfo->errors);
    }

    public function testRelationships()
    {
        $userInfo = new UserInfo([
            'user_id' => 1,
            'name' => 'John Doe',
            'restaurant_id' => 1,
        ]);

        $this->assertTrue($userInfo->save());

        // Verificar se as relações estão configuradas corretamente
        $this->assertInstanceOf(Restaurant::class, $userInfo->getRestaurant()->one());
        $this->assertInstanceOf(User::class, $userInfo->getUser()->one());
    }

    // Adicione mais testes conforme necessário, como validar tipos de dados, etc.
}
