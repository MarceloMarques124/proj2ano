<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cards}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%restaurants}}`
 */
class m231031_214021_create_cards_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cards}}', [
            'id' => $this->primaryKey(),
            'date_time' => $this->datetime(),
            'day_week' => $this->integer(),
            'restaurant_id' => $this->integer()->notNull(),
        ],'ENGINE=InnoDB');

        // creates index for column `restaurant_id`
        $this->createIndex(
            '{{%idx-cards-restaurant_id}}',
            '{{%cards}}',
            'restaurant_id'
        );

        // add foreign key for table `{{%restaurants}}`
        $this->addForeignKey(
            '{{%fk-cards-restaurant_id}}',
            '{{%cards}}',
            'restaurant_id',
            '{{%restaurants}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%restaurants}}`
        $this->dropForeignKey(
            '{{%fk-cards-restaurant_id}}',
            '{{%cards}}'
        );

        // drops index for column `restaurant_id`
        $this->dropIndex(
            '{{%idx-cards-restaurant_id}}',
            '{{%cards}}'
        );

        $this->dropTable('{{%cards}}');
    }
}
