<?php

use common\models\User;
use common\models\UserInfo;
use yii\db\Migration;

/**
 * Class m231124_234855_init_rbac
 */
class m231124_234855_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $roles = $auth->getRoles();

        $roleEmployee = $roles['employee'];
        $roleChef = $roles['chef'];
        $roleClient = $roles['client'];
        $roleManager = $roles['manager'];

        $auth->assign($roleEmployee, 2);
        $auth->assign($roleChef, 3);
        $auth->assign($roleClient, 4);
        $auth->assign($roleManager, 5);

        $this->createUser('admin');
        $this->createUser('employee');
        $this->createUser('chef');
        $this->createUser('client');
        $this->createUser('manager');
    }

    public function createUser($roleName)
    {
        $user = new User();
        $user->username = $roleName;
        $user->email = $roleName . '@' . $roleName . '.test';
        $user->setPassword('password');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = 10;

        $success = $user->save();
        echo $success;

        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->name = $roleName;
        $userInfo->address = 'Rua do ' . $roleName;
        $userInfo->door_number = '123';
        $userInfo->postal_code = '9999-999';
        $userInfo->nif = '999999999';
        $userInfo->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231124_234855_init_rbac cannot be reverted.\n";

        return false;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231124_234855_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
