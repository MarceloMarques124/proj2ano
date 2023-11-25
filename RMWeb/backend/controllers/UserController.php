<?php

namespace backend\controllers;

use common\models\UserForm;
use common\models\UserInfo;
use common\models\UserInfoSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for UserInfo model.
 */
class UserController extends Controller
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
                            'roles' => ['admin'],
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
     * Lists all UserInfo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserInfoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserInfo model.
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
     * Finds the UserInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserInfo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new UserInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $userForm = new UserForm();

        $authManager = Yii::$app->authManager;

        $roles = $authManager->getRoles();

        if ($userForm->load(Yii::$app->request->post()) && $userForm->createUser()) {
            return $this->redirect(['view', 'id' => $userForm->userInfoId]);
        }

        return $this->render('create', [
            'userForm' => $userForm,
            'roles' => $roles
        ]);
    }

    /**
     * Updates an existing UserInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $userForm = $this->findUserForm($id);

        $authManager = Yii::$app->authManager;

        $roles = $authManager->getRoles();

        if ($userForm->load(Yii::$app->request->post()) && $userForm->updateUser()) {
            return $this->redirect(['view', 'id' => $userForm->userId]);
        }

        return $this->render('update', [
            'userForm' => $userForm,
            'roles' => $roles
        ]);
    }

    protected function findUserForm($id)
    {
        if (($userInfo = UserInfo::findOne(['id' => $id])) !== null) {

            $userForm = new UserForm();

            $userRoles = Yii::$app->authManager->getRolesByUser($userInfo->user->id);

            $userForm->userId = $userInfo->user_id;
            $userForm->username = $userInfo->user->username;
            $userForm->email = $userInfo->user->email;
            $userForm->userInfoId = $userInfo->id;
            $userForm->name = $userInfo->name;
            $userForm->address = $userInfo->address;
            $userForm->door_number = $userInfo->door_number;
            $userForm->postal_code = $userInfo->postal_code;
            $userForm->nif = $userInfo->nif;

            // vai buscar a primeira porque as roles dependem umas das outras
            if ($userRoles && count($userRoles) > 0)
                $userForm->role = reset($userRoles)->name;

            return $userForm;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing UserInfo model.
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
