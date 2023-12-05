<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_orders}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%restaurants}}`
 * - `{{%tables}}`
 * - `{{%order_states}}`
 */
class m231107_211956_create_food_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'table_id' => $this->integer(),
            'price' => $this->decimal(4, 2)->notNull(),
            'take_away' => $this->boolean()->notNull(),
            'state' => $this->integer()->notNull(),
        ],'ENGINE=InnoDB');

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-food_orders-user_id}}',
            '{{%food_orders}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-food_orders-user_id}}',
            '{{%food_orders}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `restaurant_id`
        $this->createIndex(
            '{{%idx-food_orders-restaurant_id}}',
            '{{%food_orders}}',
            'restaurant_id'
        );

        // add foreign key for table `{{%restaurants}}`
        $this->addForeignKey(
            '{{%fk-food_orders-restaurant_id}}',
            '{{%food_orders}}',
            'restaurant_id',
            '{{%restaurants}}',
            'id',
            'CASCADE'
        );

        // creates index for column `table_id`
        $this->createIndex(
            '{{%idx-food_orders-table_id}}',
            '{{%food_orders}}',
            'table_id'
        );

        // add foreign key for table `{{%tables}}`
        $this->addForeignKey(
            '{{%fk-food_orders-table_id}}',
            '{{%food_orders}}',
            'table_id',
            '{{%tables}}',
            'id',
            'CASCADE'
        );

        // creates index for column `state`
        $this->createIndex(
            '{{%idx-food_orders-state}}',
            '{{%food_orders}}',
            'state'
        );

        // add foreign key for table `{{%order_states}}`
        $this->addForeignKey(
            '{{%fk-food_orders-state}}',
            '{{%food_orders}}',
            'state',
            '{{%order_states}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-food_orders-user_id}}',
            '{{%food_orders}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-food_orders-user_id}}',
            '{{%food_orders}}'
        );

        // drops foreign key for table `{{%restaurants}}`
        $this->dropForeignKey(
            '{{%fk-food_orders-restaurant_id}}',
            '{{%food_orders}}'
        );

        // drops index for column `restaurant_id`
        $this->dropIndex(
            '{{%idx-food_orders-restaurant_id}}',
            '{{%food_orders}}'
        );

        // drops foreign key for table `{{%tables}}`
        $this->dropForeignKey(
            '{{%fk-food_orders-table_id}}',
            '{{%food_orders}}'
        );

        // drops index for column `table_id`
        $this->dropIndex(
            '{{%idx-food_orders-table_id}}',
            '{{%food_orders}}'
        );

        // drops foreign key for table `{{%order_states}}`
        $this->dropForeignKey(
            '{{%fk-food_orders-state}}',
            '{{%food_orders}}'
        );

        // drops index for column `state`
        $this->dropIndex(
            '{{%idx-food_orders-state}}',
            '{{%food_orders}}'
        );

        $this->dropTable('{{%food_orders}}');
    }
}
