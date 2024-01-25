<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int $restaurant_id
 * @property float $price
 * @property int $state
 *
 * @property OrderedMenu[] $orderedMenus
 * @property Restaurant $restaurant
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'restaurant_id', 'price', 'state'], 'required'],
            [['user_id', 'restaurant_id', 'state'], 'integer'],
            [['price'], 'number'],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user.name' => 'User Name',
            'restaurant.name' => 'Restaurant Name',
            'price' => 'Price',
            'state' => 'State',
        ];
    }

    /**
     * Gets query for [[OrderedMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderedMenus()
    {
        return $this->hasMany(OrderedMenu::class, ['order_id' => 'id']);
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
