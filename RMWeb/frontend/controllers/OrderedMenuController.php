<?php

namespace frontend\controllers;

use common\models\Menu;
use common\models\Order;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\OrderedMenu;
use yii\web\NotFoundHttpException;
use frontend\models\OrderedMenuSearch;

/**
 * OrderedMenuController implements the CRUD actions for OrderedMenu model.
 */
class OrderedmenuController extends Controller
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
     * Lists all OrderedMenu models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new OrderedMenuSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderedMenu model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrderedMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new OrderedMenu();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrderedMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $menu = Menu::findOne(['id' => $model->menu_id]);
        $order = Order::findOne(['id' => $model->order_id]);

        $quantityBeforeUpdate = $model->quantity;

        

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                if ($model->quantity >= 0) {
                $quantityAfterUpdate = $model->quantity;
                if ($quantityAfterUpdate > $quantityBeforeUpdate) {
                    $quantityDifference = $quantityAfterUpdate - $quantityBeforeUpdate;
                    $order->price += $menu->price * $quantityDifference;
                    $order->save();
                } else {
                    $quantityDifference = $quantityBeforeUpdate - $quantityAfterUpdate;
                    $order->price -= $menu->price * $quantityDifference;
                    $order->save();
                }
                return $this->redirect(['order/view', 'id' => $model->order_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrderedMenu model.
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
     * Finds the OrderedMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OrderedMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderedMenu::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
