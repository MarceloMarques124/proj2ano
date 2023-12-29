<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reservations}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%zones}}`
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
            'tables_number' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'date_time' => $this->datetime()->notNull(),
            'people_number' => $this->integer()->notNull(),
            'remarks' => $this->text(),
            'restaurant_id' => $this->integer()->notNull(),
            'zone_id' => $this->integer(),
        ], 'ENGINE=InnoDB');

        // creates index for column `table_id`
        $this->createIndex(
            '{{%idx-reservations-zone_id}}',
            '{{%reservations}}',
            'zone_id'
        ); 

        // add foreign key for table `{{%tables}}`
        $this->addForeignKey(
            '{{%fk-reservations-zone_id}}',
            '{{%reservations}}',
            'zone_id',
            '{{%zones}}',
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
            '{{%fk-reservations-zone_id}}',
            '{{%reservations}}'
        );

        // drops index for column `table_id`
        $this->dropIndex(
            '{{%idx-reservations-zone_id}}',
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
