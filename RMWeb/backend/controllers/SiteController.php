<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

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
                            'actions' => ['logout'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['index'],
                            'allow' => false,
                            'roles' => ['client'],
                        ]
                ],
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
        return $this->render('index');
    }

    public function actionLoginFront(){
        
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
            if (\Yii::$app->user->can('employee'))
            {
                // yes he is Admin, so redirect page 
                return $this->goBack();
            }
            else // if he is not an Admin then what :P
            {   // put him out :P Automatically logout. 
                Yii::$app->user->logout();
                // set error on login page. 
                \Yii::$app->getSession()->setFlash('error', 'You are not authorized to login Admin\'s penal.<br /> Please use valid Username & Password.<br />Please contact Administrator for details.');
                //redirect again page to login form.
                return $this->redirect(['site/login']);
            }
    
        } else {
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

        return $this->goHome();
    }
}
