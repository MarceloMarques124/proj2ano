<?php

namespace backend\modules\api\controllers;

use yii\web\Controller;
use yii\rest\ActiveController;

class ReviewController extends ActiveController
{
    public $modelClass = 'common\models\Review';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}