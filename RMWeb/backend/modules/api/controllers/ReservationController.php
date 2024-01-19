<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use common\models\Reservation;
use common\models\User;
use Yii;

class ReviewController extends ActiveController
{
    public $modelClass = 'common\models\Reservation';

    /**
     * Renders the index view for the module
     * @return string
     */

     public function actions()
     {
         $actions = parent::actions();
 
         // Disable default actions
         unset($actions['index']);
 
         return $actions;
     }
 
     public function actionIndex()
     {
        $data = Yii::$app->request->get(); // Removido o 'load', pois 'get()' já retorna um array
        $user = User::findOne(['token' => $data->token]);

        if ($user) {
            $reserves = Reservation::find()->where(['user_id' => $user->id])->all();

            $result = [];

            foreach ($reserves as $reserve) {
                $result[] = [
                    'reservation_id' => $reserve->id,
                    'tables_number' => $reserve->tables_number,
                    'date_time' => $reserve->date_time,
                    'people_number' => $reserve->people_number,
                    'remarks' => $reserve->remarks,
                    'user' => $user->name, // Altere 'name' para o campo correto no modelo User
                    'restaurant' => $reserve->restaurant->name, // Altere 'name' para o campo correto no modelo Restaurant
                ];
            }

            return $result;
        } else {
            return ['error' => 'User not found'];
        }
    }
}