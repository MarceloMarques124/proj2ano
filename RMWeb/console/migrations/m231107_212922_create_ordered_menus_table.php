<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordered_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%menus}}`
 * - `{{%orders}}`
 */
class m231107_212922_create_ordered_menus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordered_menus}}', [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
        ], 'ENGINE=InnoDB');

        // creates index for column `menu_id`
        $this->createIndex(
            '{{%idx-ordered_menus-menu_id}}',
            '{{%ordered_menus}}',
            'menu_id'
        );

        // add foreign key for table `{{%menus}}`
        $this->addForeignKey(
            '{{%fk-ordered_menus-menu_id}}',
            '{{%ordered_menus}}',
            'menu_id',
            '{{%menus}}',
            'id',
            'CASCADE'
        );

        // creates index for column `menu_id`
        $this->createIndex(
            '{{%idx-ordered_menus-order_id}}',
            '{{%ordered_menus}}',
            'order_id'
        );

        // add foreign key for table `{{%menus}}`
        $this->addForeignKey(
            '{{%fk-ordered_menus-order_id}}',
            '{{%ordered_menus}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%menus}}`
        $this->dropForeignKey(
            '{{%fk-ordered_menus-menu_id}}',
            '{{%ordered_menus}}'
        );

        // drops index for column `menu_id`
        $this->dropIndex(
            '{{%idx-ordered_menus-menu_id}}',
            '{{%ordered_menus}}'
        );

        // drops foreign key for table `{{%menus}}`
        $this->dropForeignKey(
            '{{%fk-ordered_menus-order_id}}',
            '{{%ordered_menus}}'
        );

        // drops index for column `menu_id`
        $this->dropIndex(
            '{{%idx-ordered_menus-order_id}}',
            '{{%ordered_menus}}'
        );

        $this->dropTable('{{%ordered_menus}}');
    }
}
