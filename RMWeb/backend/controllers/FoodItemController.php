<?php

namespace backend\controllers;

use Yii;
use common\models\Menu;
use yii\web\Controller;
use common\models\FoodItem;
use yii\filters\VerbFilter;
use backend\models\FoodItemSearch;
use yii\web\NotFoundHttpException;

/**
 * FooditemController implements the CRUD actions for FoodItem model.
 */
class FooditemController extends Controller
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
     * Lists all FoodItem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FoodItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FoodItem model.
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
     * Creates a new FoodItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {

        // Verifica se existem restaurantes
        $menus = Menu::find()->all();

        if (empty($menus)) {
            // Redireciona o usuário ou exibe uma mensagem informando sobre a indisponibilidade
            Yii::$app->session->setFlash('noRest', 'Não é possível criar um item de menu porque não há menus disponíveis.');
            return $this->redirect(['menu/index']); // ou outra ação apropriada
        }

        $model = new FoodItem();
        $model->menu_id = $id;

        $menu = Menu::findOne(['id' => $id]);
        $foodItem = FoodItem::find(['menu_id' => $id])->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($foodItem) {
                    $menu->price += $model->price;
                } else {
                    $menu->price = 0;
                    $menu->price += $model->price;
                }

                $menu->save();
                return $this->redirect(['menu/view', 'id' => $model->menu_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FoodItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // Verifica se existem menus
        $menus = Menu::find()->all();
        $model = $this->findModel($id);

        $menu = Menu::findOne(['id' => $model->menu_id]);
        $foodItem = Fooditem::findOne(['id' => $model->id]);


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $menu->price -= $foodItem->price;
            $menu->price += $model->price;
            $menu->save();
            return $this->redirect(['menu/view', 'id' => $model->menu_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'menus' => $menus
        ]);
    }

    /**
     * Deletes an existing FoodItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $foodItem = $this->findModel($id);
        $menu = Menu::findOne(['id' => $foodItem->menu_id]);
        $menu->price -= $foodItem->price;
        $menu->save();
        if ($menu->save())
            $foodItem->delete();
        // Redirecionar para a view do Menu com base no ID do Menu
        return $this->redirect(['menu/view', 'id' => $foodItem->menu_id]);
    }

    /**
     * Finds the FoodItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return FoodItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FoodItem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
