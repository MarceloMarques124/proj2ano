<?php

namespace backend\modules\api\controllers;

use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class RestaurantController extends ActiveController
{
    public $modelClass = 'common\models\Restaurant';
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
