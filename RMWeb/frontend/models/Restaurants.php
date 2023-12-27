<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "restaurants".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property int $nif
 * @property string $email
 * @property string $mobile_number
 *
 * @property Cards[] $cards
 * @property FoodOrders[] $foodOrders
 * @property Menus[] $menuses
 * @property Reviews[] $reviews
 * @property Zones[] $zones
 */
class Restaurants extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nif', 'email', 'mobile_number'], 'required'],
            [['nif'], 'integer'],
            [['name', 'address', 'email'], 'string', 'max' => 100],
            [['mobile_number'], 'string', 'max' => 20],
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
            'address' => 'Address',
            'nif' => 'Nif',
            'email' => 'Email',
            'mobile_number' => 'Mobile Number',
        ];
    }

    /**
     * Gets query for [[Cards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCards()
    {
        return $this->hasMany(Cards::class, ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[FoodOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodOrders()
    {
        return $this->hasMany(FoodOrders::class, ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[Menuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenuses()
    {
        return $this->hasMany(Menus::class, ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[Zones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getZones()
    {
        return $this->hasMany(Zones::class, ['restaurant_id' => 'id']);
    }
}
