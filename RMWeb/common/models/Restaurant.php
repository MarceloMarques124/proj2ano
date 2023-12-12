<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "restaurants".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property int $nif
 * @property string $email
 * @property string $mobile_number
 */
class Restaurant extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nif', 'email', 'mobile_number'], 'required'],
            [['nif'], 'integer'],
            [['name', 'address', 'email'], 'string', 'max' => 100],
            [['mobile_number'], 'string', 'max' => 20],
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
            'address' => 'Address',
            'nif' => 'Nif',
            'email' => 'Email',
            'mobile_number' => 'Mobile Number',
        ];
    }

}
