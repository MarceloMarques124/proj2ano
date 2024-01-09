<?php

use common\models\Restaurant;
use common\models\Table;
use common\models\User;
use common\models\UserInfo;
use common\models\Zone;
use \common\models\Review;
use common\models\Menu;
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
        $roleClient = $roles['client'];
        $roleManager = $roles['manager'];


        $auth->assign($roleEmployee, 2);
        $auth->assign($roleClient, 3);
        $auth->assign($roleManager, 4);

        foreach (array('admin', 'employee', 'client', 'manager') as $role) {
            $this->createUser($role);
        }

        foreach (array('Restaurante Muito Bom', 'Restaurante Bom', 'Restaurante Mais ou Menos', 'Restaurante Mau', 'Restaurante Muito Mau') as $restaurantName) {
            $this->createRestaurant($restaurantName);
        }

        foreach (array('One - 1', 'Two - 2', 'Tree - 3') as $menuName){
            $this->createMenu($menuName);
        }

        for($i = 0; $i < 15; $i++){
            $this->createReview();
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

            $zone->name = $zoneName;
            $zone->description = $restaurantName . ' - ' . $zoneName;
            $zone->restaurant_id = $restaurant->id;
            $zone->capacity = 20;
            $zone->save();

            foreach (array('Mesa Muito Boa', 'Mesa Boa', 'Mesa Mais ou Menos', 'Mesa Má', 'Mesa Muito Má') as $tableDescription) {
                $table = new Table();
                $table->description = $restaurantName .' - ' . $tableDescription;
                $table->capacity = 4;
                $table->save();
            }
        }
    }

    public function createMenu($menuName)
    {
        $menu = new Menu();

        $menu->name = 'Menu ' . $menuName;
        $menu->price = 10.2;
        $menu->restaurant_id = 1;
        $menu->save();
    }

    public function createReview(){
        $review = new Review();

        $review->restaurant_id = 1;
        $review->description = "review teste";
        $review->user_id = 1;
        $review->stars = 4;

        $review->save();

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
