<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservations".
 *
 * @property int $id
 * @property int $table_id
 * @property int $user_id
 * @property string $date_time
 * @property int $people_number
 * @property string|null $remarks
 *
 * @property Table $table
 * @property User $user
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
            [['table_id', 'user_id', 'date_time', 'people_number'], 'required'],
            [['table_id', 'user_id', 'people_number'], 'integer'],
            [['date_time'], 'safe'],
            [['remarks'], 'string'],
            [['table_id'], 'unique'],
            [['user_id'], 'unique'],
            [['table_id'], 'exist', 'skipOnError' => true, 'targetClass' => Table::class, 'targetAttribute' => ['table_id' => 'id']],
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
            'table_id' => 'Table ID',
            'user_id' => 'User ID',
            'date_time' => 'Date Time',
            'people_number' => 'People Number',
            'remarks' => 'Remarks',
        ];
    }

    /**
     * Gets query for [[Table]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Table::class, ['id' => 'table_id']);
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
