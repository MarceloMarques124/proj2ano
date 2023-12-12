<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 * @property int $restaurant_id
 * 
 *
 * @property User $user
 * @property Restaurant $restaurant
 * 
 */
class UserInfo extends ActiveRecord
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
            [['user_id', 'nif'], 'integer'],
            [['name', 'address'], 'string', 'max' => 100],
            [['door_number'], 'string', 'max' => 50],
            [['postal_code'], 'string', 'max' => 20],
            [['user_id'], 'unique'],
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
            'user_id' => 'User ID',
            'name' => 'Name',
            'address' => 'Address',
            'door_number' => 'Door Number',
            'postal_code' => 'Postal Code',
            'nif' => 'Nif',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'user_id']);
    }
}
