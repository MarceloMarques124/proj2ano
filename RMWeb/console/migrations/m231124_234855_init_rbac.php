<?php

use common\models\Restaurant;
use common\models\Table;
use common\models\User;
use common\models\UserInfo;
use common\models\Zone;
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

        foreach (array('admin', 'employee', 'chef', 'client', 'manager') as $role) {
            $this->createUser($role);
        }

        foreach (array('Restaurante Muito Bom', 'Restaurante Bom', 'Restaurante Mais ou Menos', 'Restaurante Mau', 'Restaurante Muito Mau') as $restaurantName) {
            $this->createRestaurant($restaurantName);
        }
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
        $user->save();

        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->name = $roleName;
        $userInfo->address = 'Rua do ' . $roleName;
        $userInfo->door_number = '123';
        $userInfo->postal_code = '9999-999';
        $userInfo->nif = '999999999';
        $userInfo->save();
    }

    public function createRestaurant($restaurantName)
    {
        $restaurant = new Restaurant();

        $restaurant->name = $restaurantName;
        $restaurant->address = 'Rua do ' . $restaurantName;
        $restaurant->nif = '999999999';
        $restaurant->email = $restaurantName . '@' . $restaurantName . '.test';
        $restaurant->mobile_number = '981234567';
        $restaurant->save();


        foreach (array('Esplanada', 'Dentro', 'Fora', 'Café', 'Restaurante') as $zoneName) {
            $zone = new Zone();

            $zone->name = $restaurantName . ' - ' . $zoneName;
            $zone->description = $restaurantName . ' - ' . $zoneName;
            $zone->restaurant_id = $restaurant->id;
            $zone->save();

            foreach (array('Mesa Muito Boa', 'Mesa Boa', 'Mesa Mais ou Menos', 'Mesa Má', 'Mesa Muito Má') as $tableDescription) {
                $table = new Table();

                $table->zone_id = $zone->id;
                $table->description = $restaurantName . ' - ' . $zoneName . ' - ' . $tableDescription;
                $table->capacity = 4;
                $table->save();
            }
        }


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
