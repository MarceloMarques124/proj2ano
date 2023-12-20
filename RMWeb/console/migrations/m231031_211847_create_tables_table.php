<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tables}}`.
 * Has foreign keys to the tables:
 *

 */
class m231031_211847_create_tables_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tables}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string(200),
            'capacity' => $this->integer()->notNull()
        ],'ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tables}}');
    }
}
