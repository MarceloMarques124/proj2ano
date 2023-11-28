<?php

namespace common\models;

use Yii;

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
 * @property Menus $menu
 * @property OrderedItems[] $orderedItems
 */
class FoodItem extends \yii\db\ActiveRecord
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
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::class, 'targetAttribute' => ['menu_id' => 'id']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getFoodItemsIngredients()
    {
        return $this->hasMany(FoodItemsIngredients::class, ['food_items_id' => 'id']);
    }

    /**
     * Gets query for [[Ingredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredients::class, ['id' => 'ingredients_id'])->viaTable('food_items_ingredients', ['food_items_id' => 'id']);
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::class, ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[OrderedItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderedItems()
    {
        return $this->hasMany(OrderedItems::class, ['food_item_id' => 'id']);
    }
}
