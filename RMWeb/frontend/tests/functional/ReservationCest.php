<?php

namespace frontend\tests\functional;

use common\fixtures\RestaurantFixture;
use common\models\Restaurant;
use common\models\User;
use frontend\tests\FunctionalTester;

class ReservationCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */

    public function _before(FunctionalTester $I)
    {
        $authManager = \Yii::$app->authManager;
        $authManager->assign($authManager->getRole('Cliente'), User::findOne(['username' => 'client'])->id);



        $I->amOnRoute('site/login');
    }

    public function checkRoute(FunctionalTester $I){
        $I->see("Reserves");
    }
}