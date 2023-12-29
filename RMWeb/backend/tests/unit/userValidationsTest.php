<?php


namespace backend\tests\Unit;

use common\models\User;
use common\models\UserInfo;
use backend\tests\UnitTester;

class userValidationsTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $userInfo = new \common\models\UserInfo();

        // Configurar valores inválidos
        $userInfo->name = null;
        // Verificar se o modelo não é válido
        $this->assertFalse($userInfo->validate(['name']));

        // Verificar se há um erro para o campo 'username'
        $this->assertTrue($userInfo->hasErrors('name'));
    }
}
