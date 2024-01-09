<?php


namespace frontend\tests\Functional;

use common\models\User;
use frontend\tests\FunctionalTester;

class reserveCest
{
    public function _before(FunctionalTester $I)
    {
        $authManager = \Yii::$app->authManager;
        $authManager->assign($authManager->getRole('client'), User::findOne(['username' => 'erau'])->id);
        $I->amLoggedInAs(User::findOne(['username' => 'erau']));
    }

    public function fillAndSubmitReservationForm(FunctionalTester $I)
    {
        $I->amOnRoute('reserve/create');
        $I->see('Create Reservation');
    }
}
