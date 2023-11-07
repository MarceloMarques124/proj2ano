<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%restaurants}}`.
 */
class m231031_191231_create_restaurants_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%restaurants}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'address' => $this->string(100),
            'nif' => $this->integer()->notNull(),
            'email' => $this->string(100)->notNull(),
            'mobile_number' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%restaurants}}');
    }
}
