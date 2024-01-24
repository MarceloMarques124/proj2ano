<?php

namespace backend\modules\api\controllers;

use common\models\Menu;
use common\models\Order;
use common\models\OrderedMenu;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class OrderController extends ActiveController
{
    public $modelClass = 'common\models\Order';
    
    /**
     * Renders the index view for the module
     * @return string
     */
    


    public function actionIndex()
    {
        $data = Yii::$app->request->get('token');
        $user = User::findByVerificationToken($data);

        if ($user) {
            $orders = Order::find()->where(['user_id' => $user->id])->all();

            $result = [];

            foreach ($orders as $order) {
                $result[] = [
                    'order_id' => $order->id,
                    'user' => $user->username, 
                    'restaurant' => $order->restaurant->name,
                    'price' => $order->zone->name 
                ];
            }

        } else {
            return ['error' => 'User not found'];
        }
            return $result;
    }

    public function actionPay($id)
    {
        $order = Order::findOne($id);

        if ($order && $order->state == 1) {
            $order->state = 2;
            $this->actionCreateinvoice($id);
            $order->save();
            return "Pedido pago";
        }
    }

    public function actionCreateinvoice()
    {
     $params = json_decode(Yii::$app->request->getRawBody(), true);
    // $params = Yii::$app->request->post();


    //  foreach ($params as $param) {
    //      $ordered = new OrderedMenu();
    //      $ordered->id = $param['id'];
    //      $ordered->menu_id = $param['menu_id'];
    //      $ordered->quantity = $param['quantity'];
    //      $ordered->order_id = $param['order_id'];
         
         
    //      if ($ordered->save()) {
    //          $order = Order::findOne(['id' => $ordered->order_id]);
    //          $menu = Menu::findOne(['id' => $ordered->menu_id]);

    //          $order->price += ($ordered->quantity*$menu->price); 
    //          $order->save();

    //          return "Was Created";
    //      } else {
    //          return "Failed to create invoice";
    //      }
    //  }
    $params = Yii::$app->request->post();

    foreach ($params as $param) {
        $ordered = new OrderedMenu();
        $ordered->id = $param['id'];
        $ordered->menu_id = $param['menu_id'];
        $ordered->quantity = $param['quantity'];
        $ordered->order_id = $param['order_id'];

        if (!$ordered->save()) {
            return "Failed to create invoice";
        }

        $order = Order::findOne(['id' => $ordered->order_id]);
        $menu = Menu::findOne(['id' => $ordered->menu_id]);

        $order->price += ($ordered->quantity * $menu->price);
        $order->save();
    }

    return "All invoices were created successfully";
    }
}