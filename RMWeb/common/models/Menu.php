<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menus".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $restaurant_id
 *
 * @property FoodItem[] $foodItems
 * @property OrderedMenu[] $orderedMenus
 * @property Restaurant $restaurant
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'restaurant_id'], 'required'],
            [['price'], 'number'],
            [['restaurant_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'restaurant_id' => 'Restaurant ID',
        ];
    }

    /**
     * Gets query for [[FoodItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodItems()
    {
        return $this->hasMany(FoodItem::class, ['menu_id' => 'id']);
    }

    /**
     * Gets query for [[OrderedMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderedMenus()
    {
        return $this->hasMany(OrderedMenu::class, ['menu_id' => 'id']);
    }

    /**
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }

   /*public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $id = $this->id;
        $name = $this->name;
        $price = $this->price;
        $restaurant_id = $this->restaurant_id;

        $myObj = new \stdClass();
        $myObj->id = $id;
        $myObj->name = $name;
        $myObj->price = $price;
        $myObj->restaurant_id = $restaurant_id;
        $myJSON = json_encode($myObj);
        if ($insert)
            $this->FazPublishNoMosquitto("INSERT", $myJSON);
        else
            $this->FazPublishNoMosquitto("UPDATE", $myJSON);
    }*/

/*     public function afterDelete()
    {
        parent::afterDelete();
        $prod_id = $this->id;
        $myObj = new \stdClass();
        $myObj->id = $prod_id;
        $myJSON = json_encode($myObj);
        $this->FazPublishNoMosquitto("DELETE", $myJSON);
    } */

    // public function FazPublishNoMosquitto($canal, $msg)
    // {
    //     $server = "127.0.0.1";
    //     $port = 1883;
    //     $username = ""; // set your username
    //     $password = ""; // set your password
    //     $client_id = "phpMQTT-publisher"; // unique!
    //     $mqtt = new phpMQTT($server, $port, $client_id);
    //     if ($mqtt->connect(true, NULL, $username, $password)) {
    //         $mqtt->publish($canal, $msg, 0);
    //         $mqtt->close();
    //     } else {
    //         file_put_contents("debug.output", "Time out!");
    //     }
    // }
}
