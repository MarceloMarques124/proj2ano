<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $address
 * @property string|null $door_number
 * @property string|null $postal_code
 * @property int|null $nif
 * @property int|null $restaurant_id
 *
 * @property Restaurant $restaurant
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'nif', 'restaurant_id'], 'integer'],
            [['name', 'address'], 'string', 'max' => 100],
            [['door_number'], 'string', 'max' => 50],
            [['postal_code'], 'string', 'max' => 20],
            [['user_id'], 'unique'],
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
            'user.name' => 'a',
            'name' => 'Name',
            'address' => 'Address',
            'door_number' => 'Door Number',
            'postal_code' => 'Postal Code',
            'nif' => 'Nif',
            'restaurant.name' => 'Restaurant Name',
        ];
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
