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
 * @property OrderedItem[] $orderedItems
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
     * Gets query for [[OrderedItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderedItems()
    {
        return $this->hasMany(OrderedItem::class, ['menu_id' => 'id']);
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
}
