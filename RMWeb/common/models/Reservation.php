<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservations".
 *
 * @property int $id
 * @property int $tables_number
 * @property int $user_id
 * @property string $date_time
 * @property int $people_number
 * @property string|null $remarks
 * @property int $restaurant_id
 * @property int $zone_id
 *
 * @property Restaurant $restaurant
 * @property User $user
 * @property Zone $zone
 */
class Reservation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tables_number', 'user_id', 'date_time', 'people_number', 'restaurant_id', 'zone_id'], 'required'],
            [['tables_number', 'user_id', 'people_number', 'restaurant_id', 'zone_id'], 'integer'],
            [['date_time'], 'safe'],
            [['remarks'], 'string'],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['zone_id'], 'integer'],
            [['zone_id'], 'default', 'value' => null],
            [['zone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zone::class, 'targetAttribute' => ['zone_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tables_number' => 'Tables Number',
            'user.name' => 'User Name',
            'date_time' => 'Date Time',
            'people_number' => 'People Number',
            'remarks' => 'Remarks',
            'restaurant.name' => 'Restaurant Name',
            'zone.name' => 'Zone Name',
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

    /**
     * Gets query for [[Zone]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getZone()
    {
        return $this->hasOne(Zone::class, ['id' => 'zone_id']);
    }
}
