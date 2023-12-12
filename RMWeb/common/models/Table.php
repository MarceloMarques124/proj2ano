<?php

namespace common\models;

use Yii;
use common\models\Zone;

/**
 * This is the model class for table "tables".
 *
 * @property int $id
 * @property int $zone_id
 * @property string|null $description
 * @property int $capacity
 *
 * @property FoodOrder[] $foodOrders
 * @property Reservation $reservation
 * @property Zone $zone
 */
class Table extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['zone_id', 'capacity'], 'required'],
            [['zone_id', 'capacity'], 'integer'],
            [['description'], 'string', 'max' => 200],
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
            'zone_id' => 'Zone ID',
            'description' => 'Description',
            'capacity' => 'Capacity',
        ];
    }

    /**
     * Gets query for [[FoodOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodOrders()
    {
        return $this->hasMany(FoodOrder::class, ['table_id' => 'id']);
    }

    /**
     * Gets query for [[Reservation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservation()
    {
        return $this->hasOne(Reservation::class, ['table_id' => 'id']);
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
