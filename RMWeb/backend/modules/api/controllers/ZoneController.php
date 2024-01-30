<?php

namespace backend\modules\api\controllers;

use common\models\Restaurant;
use common\models\Zone;
use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class ZoneController extends ActiveController
{
    public $modelClass = 'common\models\Zone';

    /**
     * Renders the index view for the module
     * @return string
     */
    
     public function actionIndex()
     {
         return $this->render('index');
     }

     public function actionZonesbyrest($id)
     {
        return Zone::find()->where(['restaurant_id' => $id, ])->all();
    }
}