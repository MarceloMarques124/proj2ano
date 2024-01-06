<?php

namespace backend\modules\api\controllers;

use yii\web1\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class TableController extends ActiveController
{
    public $modelClass = 'common\models\Table';

    /**
     * Renders the index view for the module
     * @return string
     */
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}