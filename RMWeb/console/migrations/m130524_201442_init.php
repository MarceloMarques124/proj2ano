<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        //Create roles
        $role_admin = $auth->createRole('admin');
        $auth->add($role_admin);
        $role_employee = $auth->createRole('employee');
        $auth->add($role_employee);
        $role_chef = $auth->createRole('chef');
        $auth->add($role_chef);
        $role_client = $auth->createRole('client');
        $auth->add($role_client);
        $role_manager = $auth->createRole('manager');
        $auth->add($role_manager);

       // $auth->addChild();
       
        $permRestaurantManagement = $auth->createPermission('RestaurantManagement');
        $permStockManagement = $auth->createPermission('StockManagement'); //duvida
        $permOrderManagement = $auth->createPermission('OrderManagement');
        $permUserManagement = $auth->createPermission('UserManagement');
        $permReservationManagement = $auth->createPermission('ReservationManagement');



        $auth->assign($role_admin, 1);
        
        
        //create permitions
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
