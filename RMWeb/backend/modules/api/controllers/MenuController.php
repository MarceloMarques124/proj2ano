<?php

namespace backend\modules\api\controllers;

use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class MenuController extends ActiveController
{
    public $modelClass = 'common\models\Menu';
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}