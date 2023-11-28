<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_states}}`.
 */
class m231107_211752_create_order_states_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_states}}', [
            'id' => $this->primaryKey(),
            'Name' => $this->string(50)->notNull(),
        ],'ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_states}}');
    }
}
