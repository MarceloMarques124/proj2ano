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
 * @property Menus $menu
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
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'menu_id']);
    }
}
