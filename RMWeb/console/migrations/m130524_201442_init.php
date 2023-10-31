<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        #region roles
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
        #endregion
        #region permissions
        // permissions
        $permRestaurantManagement = $auth->createPermission('RestaurantManagement'); //perm admin
        $permStockManagement = $auth->createPermission('StockManagement'); //perm chef
        $permOrderManagement = $auth->createPermission('OrderManagement'); //perm employee
        $permUserManagement = $auth->createPermission('UserManagement'); // perm manager
        $permReservationManagement = $auth->createPermission('ReservationManagement'); // perm client
        $permTablesZones = $auth->createPermission('TablesZones'); // perm manager
        #endregion        
        #region child role->perm
        // add childs role --> permission
        $auth->addChild($role_admin, $permRestaurantManagement);
        $auth->addChild($role_chef, $permStockManagement);
        $auth->addChild($role_employee, $permOrderManagement);
        $auth->addChild($role_manager, $permUserManagement);
        $auth->addChild($role_client, $permReservationManagement);
        $auth->addChild($role_manager, $permTablesZones);
        #endregion       
        #region inherits

        // add childs inherits role --> role
        $auth->addChild($role_admin, $role_manager);
        $auth->addChild($role_manager, $role_chef);
        $auth->addChild($role_manager, $role_employee);
        $auth->addChild($role_employee, $role_client);
        #endregion
        // first user get id 1
        $auth->assign($role_admin, 1);
    }   

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
