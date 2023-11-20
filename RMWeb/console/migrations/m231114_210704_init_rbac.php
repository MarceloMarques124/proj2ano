<?php

use yii\db\Migration;

/**
 * Class m231114_210704_init_rbac
 */
class m231114_210704_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $chefRole = $roles['chef'];
        $employeeRole = $roles['employee'];
        $auth->addChild($chefRole, $employeeRole);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231114_210704_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231114_210704_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
