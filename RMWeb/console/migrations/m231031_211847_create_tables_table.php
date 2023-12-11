<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tables}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%zones}}`
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
            'zone_id' => $this->integer()->notNull(),
            'description' => $this->string(200),
            'capacity' => $this->integer()->notNull()
        ],'ENGINE=InnoDB');

        // creates index for column `zone_id`
        $this->createIndex(
            '{{%idx-tables-zone_id}}',
            '{{%tables}}',
            'zone_id'
        );

        // add foreign key for table `{{%zones}}`
        $this->addForeignKey(
            '{{%fk-tables-zone_id}}',
            '{{%tables}}',
            'zone_id',
            '{{%zones}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%zones}}`
        $this->dropForeignKey(
            '{{%fk-tables-zone_id}}',
            '{{%tables}}'
        );

        // drops index for column `zone_id`
        $this->dropIndex(
            '{{%idx-tables-zone_id}}',
            '{{%tables}}'
        );

        $this->dropTable('{{%tables}}');
    }
}
