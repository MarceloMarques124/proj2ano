<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "food_items".
 *
 * @property int $id
 * @property string $name
 * @property int|null $menu_id
 * @property float|null $price
 *
 * @property FoodItemsIngredients[] $foodItemsIngredients
 * @property Ingredients[] $ingredients
 * @property Menu $menu
 * @property OrderedItems[] $orderedItems
 */
class FoodItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['menu_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['menu_id' => 'id']],
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
            'menu_id' => 'Menu ID',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[FoodItemsIngredients]].
     *
     * @return ActiveQuery
     */
    public function getFoodItemsIngredients()
    {
        return $this->hasMany(FoodItemsIngredients::class, ['food_items_id' => 'id']);
    }

    /**
     * Gets query for [[Ingredients]].
     *
     * @return ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredients::class, ['id' => 'ingredients_id'])->viaTable('food_items_ingredients', ['food_items_id' => 'id']);
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::class, ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[OrderedItems]].
     *
     * @return ActiveQuery
     */
    public function getOrderedItems()
    {
        return $this->hasMany(OrderedItems::class, ['food_item_id' => 'id']);
    }
}
