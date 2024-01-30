<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Order;
use common\models\OrderedMenu;
use common\models\UserInfo;
use yii\filters\VerbFilter;
use common\models\Prestacao;
use frontend\models\OrderSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $orderedMenusDataProvider = new ActiveDataProvider([
            'query' => OrderedMenu::find()->where(['order_id' => $model->id]),
        ]);
        
        return $this->render('view', [
            'model' => $model,
            'orderedMenusDataProvider' => $orderedMenusDataProvider
        ]);

    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPay($id)
    {
        $order = $this->findModel($id);
        $user = UserInfo::findOne(['id' => $order->user_id]);
        // Check order status
        if($order->state == 'payment'){
            // Redirect to payment page
            return $this->render('pay', [
                'orderPrice' => $order->price,
                'orderId' => $order->id,
                'user' => $user
            ]);
        }
        /* $order = Order::findOne(['id' => $id]);
        $order->state = 2;
        $order->save();
        return $this->redirect(['index']); */
    }

    public function actionPayorder($id)
    {
        $order = $this->findModel($id);
        // Check order status
        if($order){
            $order->state = "paid";
            $order->save();
            // Redirect to payment page
            return $this->redirect(['order/index']);
        }
        /* $order = Order::findOne(['id' => $id]);
        $order->state = 2;
        $order->save();
        return $this->redirect(['index']); */
    }

    public function actionTimes($id)
    {
        $order = Order::findOne(['id' => $id]);
        if ($order->state == 1) {
            $order->state = 3;
            $order->save();

            $prestacao = new Prestacao();
            $prestacao->user_id = $order->user_id;
            $prestacao->data = date('Y-m-d H:i:s');
            $prestacao->montante = $order->price;
            $prestacao->order_id = $order->id;
            $prestacao->save();
        }
        return $this->redirect(['index']);
    }
}
