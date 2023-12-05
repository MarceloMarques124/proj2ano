<?php

namespace common\models;

use common\models\Zone;


use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property int $id
 * @property int $zone_id
 * @property string|null $description
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
            [['zone_id'], 'required'],
            [['zone_id'], 'integer'],
            [['zone_id'], 'exist', 'targetClass' => Zone::className(), 'targetAttribute' => ['zone_id' => 'id']],
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
            'zone_id' => 'Zone ID',
            'description' => 'Description',
        ];
    }
}
