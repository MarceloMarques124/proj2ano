<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use common\models\Review;

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
}