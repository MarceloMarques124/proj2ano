<?php

namespace backend\modules\api\controllers;

use backend\models\AuthAssignment;
use common\models\LoginForm;
use common\models\Restaurant;
use common\models\SignupForm;
use common\models\User;
use common\models\UserInfo;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\Console\SignalRegistry\SignalMap;
use Yii;
use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    /**
     * Renders the index view for the module
     * @return string
     */
    
     public function actionIndex()
     {
         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         $users = User::find()->all();
         $responseArray = [];
     
         foreach ($users as $user) {
             $userInfo = UserInfo::findOne($user->id);
     
             $responseArray[] = [
                 'id' => $userInfo->id,
                 'username' => $user->username,
                 'name' => $userInfo->name,
                 'email' => $user->email,
                 'address' => $userInfo->address,
                 'door_number' => $userInfo->door_number,
                 'postal_code' => $userInfo->postal_code,
                 'nif' => $userInfo->nif,
             ];
         }
         return $responseArray;
     }
     

     public function actionLogin(){
        $form = new LoginForm();
        $form->load(Yii::$app->request->post(), '');
        $user = User::findByUsername($form->username);
        $role = AuthAssignment::findOne(['user_id' => $user->id])->item_name;

        if ($role == "Client"){
            return "Denied Access";
        }else{
            $userInfo = UserInfo::findOne($user->id);
            $responseArray =[
                'id' => $userInfo->id,
                'username' => $user->username,
                'name' => $userInfo->name,
                'email' => $user->email,
                'address' => $userInfo->address,
                'door_number' => $userInfo->door_number,
                'postal_code' => $userInfo->postal_code,
                'nif' => $userInfo->nif,
                'token' => $user->verification_token,
            ];
            return $responseArray;
        }
        Yii::$app->response->statusCode = 401;
        return "Denied Access";
    }

    public function actionSignup(){
        $form = new SignupForm();
        $form->load(Yii::$app->request->post(), '');

        if($form->signup()){
            return ["response" => "Sucefull regist"];
        }else{
            
            $errors = $form->getErrors();
            return ['status' => 'error', 'message' => 'Registration failed', 'errors' => $errors];
            // $errors=[];
            // foreach($form->errors as $error){
            //     $errors[] = $error;
            // }
            // return "Denied Access" . $errors;
        }
    }

    public function actionEditUser($id)
    {
        $user = User::findOne($id);
        
        if (!$user) {
            Yii::$app->response->statusCode = 404;
            return "User not found";
        }

        $userInfo = UserInfo::findOne($id);

        if (!$userInfo) {
            Yii::$app->response->statusCode = 404;
            return "UserInfo not found";
        }

        $postData = Yii::$app->request->post();

        if ($user->load($postData, '') && $userInfo->load($postData, '')) {
            if ($user->save() && $userInfo->save()) {
                Yii::$app->response->statusCode = 200;
                return "User and UserInfo updated successfully";
            } else {
                Yii::$app->response->statusCode = 422;
                return "Failed to update User and UserInfo";
            }
        } else {
            Yii::$app->response->statusCode = 422;
            return "Invalid data provided";
        }
    }

}
