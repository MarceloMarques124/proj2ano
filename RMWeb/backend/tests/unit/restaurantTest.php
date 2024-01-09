<?php


namespace backend\tests\Unit;

use Yii;
use common\models\Menu;
use backend\tests\UnitTester;
use common\models\Restaurant;

class restaurantTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $restaurantId;

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

        $this->restaurantId = $restaurant->id;
    }

    public function testReadRestaurant()
    {
        // Agora você pode acessar $this->restaurantId aqui
        $restaurant = Restaurant::find()->where(['id' => $this->restaurantId])->one();

        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertEquals('Test Restaurant', $restaurant->name);
        $this->assertEquals('Test', $restaurant->address);

    }

    /**
     * @depends testReadRestaurant
     */
    public function testUpdateRestaurant()
    {
        $restaurant = Restaurant::findOne($this->restaurantId);
        $this->assertInstanceOf(Restaurant::class, $restaurant);

        $restaurant->name = 'Updated Restaurant';
        $restaurant->save();

        $updatedRestaurant = Restaurant::findOne($this->restaurantId);

        $this->assertEquals('Updated Restaurant', $updatedRestaurant->name);
    }

    /**
     * @depends testUpdateRestaurant
     */
    public function testDeleteRestaurant()
    {
        $restaurant = Restaurant::findOne($this->restaurantId);
        $this->assertInstanceOf(Restaurant::class, $restaurant);

        $restaurant->delete();

        $deletedRestaurant = Restaurant::findOne($this->restaurantId);
        $this->assertNull($deletedRestaurant);
    }

    public function testRestaurantMenusRelation()
    {
        $menu = new Menu();
        $menu->name = 'Menu 1';
        $menu->price = 10;
        $menu->restaurant_id = $this->restaurantId;
        $menu->save();

        $restaurant = Restaurant::findOne($this->restaurantId);

        $this->assertCount(1, $restaurant->menus);
        $this->assertInstanceOf(Menu::class, $restaurant->menus[0]);
    }
}
