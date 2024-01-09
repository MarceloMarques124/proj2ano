<?php


namespace backend\tests\Unit;

use common\models\Zone;
use backend\tests\UnitTester;
use common\models\Restaurant;

class zoneTest extends \Codeception\Test\Unit
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

    public function testSaveWrongInfo()
    {
        // Create a user first
        $zone = new Zone();
        $zone->name = '';
        $zone->capacity = '';
        $zone->restaurant_id = 2;
        $this->assertFalse($zone->save());
    }

    public function testSaveValidInfo()
    {
        // Create a user first
        $zone = new Zone();
        $zone->name = 'zona 1';
        $zone->capacity = '4';
        $zone->restaurant_id = $this->restaurantId;
        $this->assertTrue($zone->save());

        // Ensure the record is saved in the database
        $dbZone = Zone::findOne($zone->id);
        $this->assertNotNull($dbZone);
        $this->assertEquals('zona 1', $dbZone->name);
        $this->assertEquals(4, $dbZone->capacity);
        $this->assertEquals($this->restaurantId, $dbZone->restaurant_id);
    }
}
