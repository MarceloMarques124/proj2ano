<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zones".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $restaurant_id
 */
class Zone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'restaurant_id'], 'required'],
            [['restaurant_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
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
            'description' => 'Description',
            'restaurant_id' => 'Restaurant ID',
        ];
    }
}
