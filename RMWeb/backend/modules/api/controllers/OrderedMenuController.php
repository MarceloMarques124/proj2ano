<?php

namespace backend\modules\api\controllers;

use common\models\Order;
use common\models\OrderedMenu;
use common\models\User;
use Yii;
use yii\web1\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class OrderedmenuController extends ActiveController
{
    public $modelClass = 'common\models\OrderedMenu';

    /**
     * Renders the index view for the module
     * @return string
     */
    
    public function actions(){
        $actions = parent::actions();         //sem utilização
        unset($actions['index']);
    }
    
    public function actionIndex()
    {
        $data = Yii::$app->request->get('token');
        $user = User::findByVerificationToken($data);

        if ($user) {
            $order = Order::find()->where(['user_id' => $user->id])->One();
            $orderedMenus = OrderedMenu::find()->where(['order_id' => $order->id])->all();

            $result = [];

            foreach ($orderedMenus as $ordered) {
                $result[] = [
                    'id' => $ordered->id,
                    'menu' => $ordered->menu->name,
                    'quantity' => $ordered->quantity,
                    'order_id' =>$order->id,
                    'user'=> $user->username
                ];
            }

        } else {
            return ['error' => 'User not found'];
        }
            return $result;
    }

    public function actionCreate(){
        $params = Yii::$app->getRequest()->getBodyParams();

        $orderedMenu = new OrderedMenu();

        $orderedMenu->menu_id = $params['menu_id'];
        $orderedMenu->quantity = $params['quantity'];
        $orderedMenu->order_id  = $params['order_id'];

        if (!$orderedMenu->save()) {
            return "Failed to create menu on order";
        }
        $orderedMenu->save();
    
        return $orderedMenu;

    }
}