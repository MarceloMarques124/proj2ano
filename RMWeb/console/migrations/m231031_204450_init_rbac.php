<?php

use yii\db\Migration;

/**
 * Class m231031_204450_init_rbac
 */
class m231031_204450_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
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
        $auth->add($permRestaurantManagement);
        $permStockManagement = $auth->createPermission('StockManagement'); //perm chef
        $auth->add($permStockManagement);
        $permOrderManagement = $auth->createPermission('OrderManagement'); //perm employee
        $auth->add($permOrderManagement);
        $permUserManagement = $auth->createPermission('UserManagement'); // perm manager
        $auth->add($permUserManagement);
        $permReservationManagement = $auth->createPermission('ReservationManagement'); // perm client
        $auth->add($permReservationManagement);
        $permTablesZones = $auth->createPermission('TablesZones'); // perm manager
        $auth->add($permTablesZones);
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231031_204450_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}