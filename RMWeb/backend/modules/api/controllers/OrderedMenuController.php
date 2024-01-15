<?php

namespace backend\modules\api\controllers;

use common\models\OrderedMenu;
use yii\web1\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class OrderedmenuController extends ActiveController
{
    public $modelClass = 'common\models\OrderedMenu';

    /**
     * Renders the index view for the module
     * @return string
     */
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}