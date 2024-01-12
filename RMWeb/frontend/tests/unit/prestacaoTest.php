<?php


namespace frontend\tests\Unit;

use common\models\User;
use common\models\Order;
use common\models\Prestacao;
use common\models\Restaurant;
use frontend\tests\UnitTester;

class prestacaoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $userId;
    protected $orderId;
    protected $restId;


    protected function _before()
    {
        // Create a user first
        $user = new User();
        $user->username = 'valid';
        $user->email = 'valid@example.com';
        $user->setPassword('password123');
        $user->generateAuthKey();
        $user->save();
        $this->userId = $user->id;


        $restaurant = new Restaurant();
        $restaurant->name = 'Test Restaurant';
        $restaurant->address = 'Test';
        $restaurant->nif = 123321123;
        $restaurant->email = 'Test@rest.com';
        $restaurant->mobile_number = '321123321';
        $restaurant->save();
        $this->restId = $restaurant->id;

        $order = new Order();
        $order->user_id = $order->id;
        $order->restaurant_id = $restaurant->id;
        $order->price = 10;
        $order->state = 1;
        $order->save();
        $this->orderId = $order->id;
    }

    // tests
    public function testSaveValidInfo()
    {
        $user = User::findOne(['id' => $this->userId]);
        $order = Order::findOne(['id' => $this->orderId]);
        $prestacao = new Prestacao();
        $prestacao->user_id = $user->id;
        $prestacao->data = '2024-10-01 23:12:12';
        $prestacao->montante = 10;
        $prestacao->order_id = $this->orderId;
        $this->assertTrue($prestacao->save());
    }
}
