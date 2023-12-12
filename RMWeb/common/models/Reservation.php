<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class Reservation extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservations';
    }

    /**
     * Gets query for [[Table]].
     *
     * @return Reservation
     */


    /**
     * {@inheritdoc}
     */

    public static function findByUserId($id)
    {
        return self::find()->where(['user_id' => $id]);
    }

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

    public function getTable()
    {
        return $this->hasOne(Table::class, ['id' => 'table_id']);
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
}
