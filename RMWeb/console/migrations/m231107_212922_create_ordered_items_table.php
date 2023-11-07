<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordered_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%food_orders}}`
 * - `{{%food_items}}`
 * - `{{%menus}}`
 * - `{{%order_states}}`
 */
class m231107_212922_create_ordered_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordered_items}}', [
            'id' => $this->primaryKey(),
            'food_order_id' => $this->integer()->notNull(),
            'food_item_id' => $this->integer(),
            'menu_id' => $this->integer(),
            'quantity' => $this->integer()->notNull(),
            'state' => $this->integer()->notNull(),
        ]);

        // creates index for column `food_order_id`
        $this->createIndex(
            '{{%idx-ordered_items-food_order_id}}',
            '{{%ordered_items}}',
            'food_order_id'
        );

        // add foreign key for table `{{%food_orders}}`
        $this->addForeignKey(
            '{{%fk-ordered_items-food_order_id}}',
            '{{%ordered_items}}',
            'food_order_id',
            '{{%food_orders}}',
            'id',
            'CASCADE'
        );

        // creates index for column `food_item_id`
        $this->createIndex(
            '{{%idx-ordered_items-food_item_id}}',
            '{{%ordered_items}}',
            'food_item_id'
        );

        // add foreign key for table `{{%food_items}}`
        $this->addForeignKey(
            '{{%fk-ordered_items-food_item_id}}',
            '{{%ordered_items}}',
            'food_item_id',
            '{{%food_items}}',
            'id',
            'CASCADE'
        );

        // creates index for column `menu_id`
        $this->createIndex(
            '{{%idx-ordered_items-menu_id}}',
            '{{%ordered_items}}',
            'menu_id'
        );

        // add foreign key for table `{{%menus}}`
        $this->addForeignKey(
            '{{%fk-ordered_items-menu_id}}',
            '{{%ordered_items}}',
            'menu_id',
            '{{%menus}}',
            'id',
            'CASCADE'
        );

        // creates index for column `state`
        $this->createIndex(
            '{{%idx-ordered_items-state}}',
            '{{%ordered_items}}',
            'state'
        );

        // add foreign key for table `{{%order_states}}`
        $this->addForeignKey(
            '{{%fk-ordered_items-state}}',
            '{{%ordered_items}}',
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
        // drops foreign key for table `{{%food_orders}}`
        $this->dropForeignKey(
            '{{%fk-ordered_items-food_order_id}}',
            '{{%ordered_items}}'
        );

        // drops index for column `food_order_id`
        $this->dropIndex(
            '{{%idx-ordered_items-food_order_id}}',
            '{{%ordered_items}}'
        );

        // drops foreign key for table `{{%food_items}}`
        $this->dropForeignKey(
            '{{%fk-ordered_items-food_item_id}}',
            '{{%ordered_items}}'
        );

        // drops index for column `food_item_id`
        $this->dropIndex(
            '{{%idx-ordered_items-food_item_id}}',
            '{{%ordered_items}}'
        );

        // drops foreign key for table `{{%menus}}`
        $this->dropForeignKey(
            '{{%fk-ordered_items-menu_id}}',
            '{{%ordered_items}}'
        );

        // drops index for column `menu_id`
        $this->dropIndex(
            '{{%idx-ordered_items-menu_id}}',
            '{{%ordered_items}}'
        );

        // drops foreign key for table `{{%order_states}}`
        $this->dropForeignKey(
            '{{%fk-ordered_items-state}}',
            '{{%ordered_items}}'
        );

        // drops index for column `state`
        $this->dropIndex(
            '{{%idx-ordered_items-state}}',
            '{{%ordered_items}}'
        );

        $this->dropTable('{{%ordered_items}}');
    }
}
