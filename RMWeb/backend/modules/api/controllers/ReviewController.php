<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use common\models\Review;
use common\models\User;
use common\models\Restaurant;
use Yii;

class ReviewController extends ActiveController
{
    public $modelClass = 'common\models\Review';

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
        $reviews = Review::find()
            ->joinWith(['user', 'restaurant'])
            ->asArray()
            ->all();
        
        $result = [];

        foreach ($reviews as $review) {
            $result[] = [
                'id' => $review['id'],
                'user_name' => $review['user']['username'],
                'restaurant_name' => $review['restaurant']['name'],
                'stars' => $review['stars'],
                'description' => $review['description'],
                // Add other fields as needed
            ];
        }
        return $result;
    }

    public function actionCreate()
    {
        $request = Yii::$app->request->post()();

        $review = new Review();
        $review->user_id = $request->user_id;
        $review->restaurant_id = $request->restaurant_id;
        $review->stars = $request->stars;
        $review->description = $request->description;

        // Verificar se os atributos estão corretamente atribuídos
        if ($review->validate() && $review->save()) {
            return ['status' => 'success', 'message' => 'Review created successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to create review.', 'errors' => $review->errors];
        }
        }
}