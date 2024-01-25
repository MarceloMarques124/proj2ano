<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property int $id
 * @property string|null $description
 * @property int $capacity
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
            [['capacity'], 'required'],
            [['capacity'], 'integer'],
            [['description'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Table Number',
            'description' => 'Description',
            'capacity' => 'Capacity',
        ];
    }
}
