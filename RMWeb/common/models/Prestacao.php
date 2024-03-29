<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prestacoes".
 *
 * @property int $id
 * @property int $user_id
 * @property string $data
 * @property int $montante
 * @property int $order_id
 *
 * @property Orders $user
 * @property User $user0
 */
class Prestacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prestacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'data', 'montante', 'order_id'], 'required'],
            [['user_id', 'montante', 'order_id'], 'integer'],
            [['data'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'data' => 'Data',
            'montante' => 'Montante',
            'order_id' => 'Order ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Order::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
