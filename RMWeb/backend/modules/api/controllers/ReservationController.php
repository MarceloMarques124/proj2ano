<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use common\models\Reservation;
use \common\models\User;
use DateTime;
use Yii;

class ReservationController extends ActiveController
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
        $data = Yii::$app->request->get('token');
        $user = User::findByVerificationToken($data);
        
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
                    'user' => $user->username, 
                    'restaurant' => $reserve->restaurant->name,
                    'zone' => $reserve->zone->name 
                ];
            }

        } else {
            return ['error' => 'User not found'];
        }
            return $result;
    }

    public function actionCreate()
    {
        $request = Yii::$app->getRequest()->getBodyParams();

        $dateTimeString = $request['date'] . ' ' . $request['time'];

        // Create a DateTime object
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTimeString);


        $reserve = new Reservation();
        $reserve->tables_number = $request['tables_number'];
        $reserve->date_time = $dateTime->format('Y-m-d H:i:s'); // Format as per your database column type
        $reserve->people_number = $request['people_number'];
        $reserve->remarks = $request['remarks'];
        $reserve->user_id = $request['user_id'];
        $reserve->restaurant_id = $request['restaurant_id'];
        $reserve->zone_id = $request['zone_id'];

        if ($reserve->validate() && $reserve->save()) {
            return ['status' => 'success', 'message' => 'Review updated successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to update review.', 'errors' => $reserve->errors];
        }
    }
}