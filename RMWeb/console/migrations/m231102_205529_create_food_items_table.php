<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%menus}}`
 */
class m231102_205529_create_food_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_items}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'menu_id' => $this->integer(),
            'price' => $this->decimal(4,2),
        ]);

        // creates index for column `menu_id`
        $this->createIndex(
            '{{%idx-food_items-menu_id}}',
            '{{%food_items}}',
            'menu_id'
        );

        // add foreign key for table `{{%menus}}`
        $this->addForeignKey(
            '{{%fk-food_items-menu_id}}',
            '{{%food_items}}',
            'menu_id',
            '{{%menus}}',
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
            '{{%fk-food_items-menu_id}}',
            '{{%food_items}}'
        );

        // drops index for column `menu_id`
        $this->dropIndex(
            '{{%idx-food_items-menu_id}}',
            '{{%food_items}}'
        );

        $this->dropTable('{{%food_items}}');
    }
}
