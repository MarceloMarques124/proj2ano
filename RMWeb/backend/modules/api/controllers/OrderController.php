<?php

namespace backend\modules\api\controllers;

use common\models\Order;
use common\models\OrderedMenu;
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
        return $this->render('index');
    }

    public function actionPay($id)
    {
        $order = Order::find($id);

        if($order->state == 1)//foi pedido para pagar/ encomendado
        {
            $order->state = 2; //está pago

            $this->actionCreateinvoice($id);

            $order->save();

            return "Pedido pago";
        }
    }

    public function actionCreateinvoice($id)
    {
        $ordered = OrderedMenu::find()->where(['order_id'=>$id])->all();




    }
}