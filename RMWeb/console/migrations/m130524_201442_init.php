<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

<<<<<<< Updated upstream
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
=======
       // $auth->addChild();
       
        $permRestaurantManagement = $auth->createPermission('RestaurantManagement');
        $permStockManagement = $auth->createPermission('StockManagement'); //duvida
        $permOrderManagement = $auth->createPermission('OrderManagement');
        $permUserManagement = $auth->createPermission('UserManagement');
        $permReservationManagement = $auth->createPermission('ReservationManagement');

        //$auth->addChild();

        $auth->assign($role_admin, 1);
        
        
        //create permitions
>>>>>>> Stashed changes
    }

    public function down()
    {
<<<<<<< Updated upstream
        $this->dropTable('{{%user}}');
=======
        $auth = Yii::$app->authManager;

        $auth->removeAll();


>>>>>>> Stashed changes
    }
}
