<?php

namespace tests\models;

use app\models\Restaurants;
use yii\base\InvalidConfigException;
use yii\db\IntegrityException;

class RestaurantsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        Restaurants::deleteAll();

    }

    protected function _after()
    {
        Restaurants::deleteAll();
    }

    public function testCreateValidRestaurant()
    {
        $restaurant = new Restaurants([
            'name' => 'Test Restaurant',
            'address' => '123 Test St',
            'nif' => 123456789,
            'email' => 'test@example.com',
            'mobile_number' => '123-456-7890',
        ]);

        $this->assertTrue($restaurant->save());
    }

    public function testRequiredFields()
    {
        $restaurant = new Restaurants();

        $this->assertFalse($restaurant->save());

       /* $this->assertArrayHasKey('name', $restaurant->errors);
        $this->assertArrayHasKey('nif', $restaurant->errors);
        $this->assertArrayHasKey('email', $restaurant->errors);
        $this->assertArrayHasKey('mobile_number', $restaurant->errors);*/
    }
}
