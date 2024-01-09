<?php


namespace backend\tests\Unit;

use common\models\Menu;
use backend\tests\UnitTester;
use common\models\Restaurant;

class menuTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $restaurantId;
    protected $menuId;

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

        $menu = new Menu();
        $menu->name = 'menu 1';
        $menu->price = 10;
        $menu->restaurant_id = $restaurant->id;
        $menu->save();
        $this->menuId = $menu->id;
    }

    public function testRequiredFields()
    {
        $menu = new Menu();
        $this->assertFalse($menu->validate(['name', 'price', 'restaurant_id']));
    }

    public function testPriceValidation()
    {
        $menu = new Menu();
        $menu->price = 'invalid_price';
        $this->assertFalse($menu->validate(['price']));
    }

    public function testRestaurantRelation()
    {
        $restaurant = Restaurant::find()->where(['id' => $this->restaurantId])->one();
        $menu = Menu::find()->where(['id' => $this->menuId])->one();

        // Set up the relation
        $restaurant->link('menus', $menu);

        // Ensure the restaurant relation is set correctly
        $this->assertInstanceOf(Restaurant::class, $menu->restaurant);
    }

    public function testMenuCreation()
    {
        $menu = new Menu();
        $menu->name = 'menu 1';
        $menu->price = 10;
        $menu->restaurant_id = $this->restaurantId;
        $menu->save();

        // Ensure the restaurant is created and linked
        $restaurant = Restaurant::findOne(['id' => $menu->restaurant_id]);
        $this->assertInstanceOf(Restaurant::class, $restaurant);
    }
}
