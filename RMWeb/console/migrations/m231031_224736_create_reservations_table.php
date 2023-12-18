<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reservations}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tables}}`
 * - `{{%user}}`
 * - `{{%restaurants}}`
 * 
 */
class m231031_224736_create_reservations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reservations}}', [
            'id' => $this->primaryKey(),
            'table_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'date_time' => $this->datetime()->notNull(),
            'people_number' => $this->integer()->notNull(),
            'remarks' => $this->text(),
            'restaurant_id' => $this->integer()->notNull(),
        ], 'ENGINE=InnoDB');

        // creates index for column `table_id`
        $this->createIndex(
            '{{%idx-reservations-table_id}}',
            '{{%reservations}}',
            'table_id'
        );

        // add foreign key for table `{{%tables}}`
        $this->addForeignKey(
            '{{%fk-reservations-table_id}}',
            '{{%reservations}}',
            'table_id',
            '{{%tables}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-reservations-user_id}}',
            '{{%reservations}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-reservations-user_id}}',
            '{{%reservations}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `restaurant_id`
        $this->createIndex(
            '{{%idx-reservations-restaurant_id}}',
            '{{%reservations}}',
            'restaurant_id'
        );

        // add foreign key for table `{{%restaurant}}`
        $this->addForeignKey(
            '{{%fk-reservations-restaurant_id}}',
            '{{%reservations}}',
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
        // drops foreign key for table `{{%tables}}`
        $this->dropForeignKey(
            '{{%fk-reservations-table_id}}',
            '{{%reservations}}'
        );

        // drops index for column `table_id`
        $this->dropIndex(
            '{{%idx-reservations-table_id}}',
            '{{%reservations}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-reservations-user_id}}',
            '{{%reservations}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-reservations-user_id}}',
            '{{%reservations}}'
        );

        // drops foreign key for table `{{%restaurant}}`
        $this->dropForeignKey(
            '{{%fk-reservations-restaurant_id}}',
            '{{%reservations}}'
        );

        // drops index for column `restaurant_id`
        $this->dropIndex(
            '{{%idx-reservations-restaurant_id}}',
            '{{%reservations}}'
        );

        $this->dropTable('{{%reservations}}');
    }
}
