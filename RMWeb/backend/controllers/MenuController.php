<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Response;
use common\models\Menu;
use yii\web\Controller;
use common\models\FoodItem;
use yii\filters\VerbFilter;
use common\models\Restaurant;
use backend\models\MenuSearch;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['update', 'index', 'delete', 'view', 'create'],
                            'allow' => true,
                            'roles' => ['MenuManagement'],
                            'denyCallback' => function ($rule, $action) {
                                throw new ForbiddenHttpException('You are not allowed to perform this action.');
                            },
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Menu models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $foodItemsDataProvider = new ActiveDataProvider([
            'query' => FoodItem::find()->where(['menu_id' => $model->id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'foodItemsDataProvider' => $foodItemsDataProvider,
        ]);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        // Verifica se existem restaurantes
        $restaurants = Restaurant::find()->all();

        if (empty($restaurants)) {
            // Redireciona o usuário ou exibe uma mensagem informando sobre a indisponibilidade
            Yii::$app->session->setFlash('noRest', 'Não é possível criar um menu porque não há restaurantes disponíveis.');
            return $this->redirect(['restaurant/index']); // ou outra ação apropriada
        }

        $model = new Menu();

        $restaurants = Restaurant::find()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // Chamada para a API para enviar a mensagem MQTT
                $this->enviarMensagemMQTTViaAPI($model->id);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Envia uma mensagem MQTT via API.
     * @param int $menuId ID do menu criado
     */
    private function enviarMensagemMQTTViaAPI($menuId)
    {
        // Construa a URL da API que corresponde ao método 'actionCreateSomething'
        $url = Url::to(['api/menu/create-something'], true);
        // Faça uma chamada HTTP para a API
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['menuId' => $menuId]);

        $resposta = curl_exec($ch);
        // Verifica por erros
        if (curl_errno($ch)) {
            // Lidar com o erro aqui
            Yii::error('Erro na chamada HTTP para a API: ' . curl_error($ch));
        }
        // Fecha a sessão cURL
        curl_close($ch);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $restaurants = Restaurant::find()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
