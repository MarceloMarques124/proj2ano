<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\User;
use yii\web\Controller;
use common\models\Order;
use common\models\Review;
use common\models\UserInfo;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\Restaurant;
use common\models\Reservation;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,

                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => false,
                        'roles' => ['client', '?'],
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->user->getIsGuest()) {
                        Yii::$app->user->loginRequired();
                    } else {
                        Yii::$app->response->redirect(Yii::$app->request->referrer);
                    }
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        $userId = Yii::$app->user->id;  // Obter o ID do usuário atual

        // Obter o papel (role) e o restaurante do usuário
        $roles = $auth->getRolesByUser($userId);
        $user = UserInfo::findOne($userId);
        foreach ($roles as $role) {
            $userRole = $role->name;  // Nome da função
        }
        $userRestaurantId = $user->restaurant_id;


        // Modificar a consulta para mostrar apenas as reservas de hoje
        $orderDataProvider = new ActiveDataProvider([
            'query' => Reservation::find()->where([
                'restaurant_id' => $userRestaurantId,
            ])->andWhere(['>=', 'date_time', date('Y-m-d 00:00:00')])
                ->andWhere(['<=', 'date_time', date('Y-m-d 23:59:59')]),
        ]);

        // Inicializar a variável que armazenará o número de reservas
        $reservasNumber = 0;
        $ordersNumber = 0;
        $ordersPending = 0;
        $reviewNumbers = 0;
        $review4Stars = 0;

        if ($userRole == 'employee' || $userRole == 'manager') {
            // Se o usuário for um employee ou manager, contar as reservas para o restaurante do usuário no dia atual
            $reservasNumber = Reservation::find()
                ->where([
                    'restaurant_id' => $userRestaurantId,
                ])
                ->andWhere(['>=', 'date_time', date('Y-m-d 00:00:00')])
                ->andWhere(['<=', 'date_time', date('Y-m-d 23:59:59')])
                ->count();

            //pedidos para hoje
            $ordersNumber = Order::find()
                ->where(['restaurant_id' => $userRestaurantId,])
                ->count();

            //pedidos pendentes
            $ordersPending = Order::find()
                ->where(['restaurant_id' => $userRestaurantId,])
                ->andWhere(['state' => 'payment'])
                ->count();

            //quantidade de review ao restaurant
            $reviewNumbers = Review::find()
                ->where(['restaurant_id' => $userRestaurantId,])
                ->count();

            //quantidade review de 4 estrelas ou mais
            $review4Stars = Review::find()
                ->where(['restaurant_id' => $userRestaurantId,])
                ->andWhere(['>=', 'stars', 4])
                ->count();
        }

        return $this->render('index', [
            'orderDataProvider' => $orderDataProvider,
            'ordersNumber' => $ordersNumber,
            'ordersPending' => $ordersPending,
            'reservasNumber' => $reservasNumber,
            'reviewNumbers' => $reviewNumbers,
            'review4Stars' => $review4Stars,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //check user roles, is user is Admin? 
            if (\Yii::$app->user->can('employee')) {
                // yes he is Admin, so redirect page 
                return $this->goBack();
            } else // if he is not an Admin then what :P
            {   // put him out :P Automatically logout. 
                Yii::$app->user->logout();
                // set error on login page. 
                \Yii::$app->getSession()->setFlash('error', 'You are not authorized to login Admin\'s penal.<br /> Please use valid Username & Password.<br />Please contact Administrator for details.');
                //redirect again page to login form.
                return $this->redirect(['site/login']);
            }
        } else {
            $this->layout = 'main-login.php';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            Yii::$app->response->statusCode = 403; // Define o status como 403 Forbidden
            return $this->render('error', ['exception' => $exception]);
        }
    }
}
