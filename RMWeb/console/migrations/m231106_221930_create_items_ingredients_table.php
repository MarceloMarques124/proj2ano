<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items_ingredients}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%food_items}}`
 * - `{{%ingredients}}`
 */
class m231106_221930_create_items_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%items_ingredients}}', [
            'id' => $this->primaryKey(),
            'food_item_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull(),
            'used_quantity' => $this->decimal(4,2)->notNull(),
        ]);

        // creates index for column `food_item_id`
        $this->createIndex(
            '{{%idx-items_ingredients-food_item_id}}',
            '{{%items_ingredients}}',
            'food_item_id'
        );

        // add foreign key for table `{{%food_items}}`
        $this->addForeignKey(
            '{{%fk-items_ingredients-food_item_id}}',
            '{{%items_ingredients}}',
            'food_item_id',
            '{{%food_items}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ingredient_id`
        $this->createIndex(
            '{{%idx-items_ingredients-ingredient_id}}',
            '{{%items_ingredients}}',
            'ingredient_id'
        );

        // add foreign key for table `{{%ingredients}}`
        $this->addForeignKey(
            '{{%fk-items_ingredients-ingredient_id}}',
            '{{%items_ingredients}}',
            'ingredient_id',
            '{{%ingredients}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%food_items}}`
        $this->dropForeignKey(
            '{{%fk-items_ingredients-food_item_id}}',
            '{{%items_ingredients}}'
        );

        // drops index for column `food_item_id`
        $this->dropIndex(
            '{{%idx-items_ingredients-food_item_id}}',
            '{{%items_ingredients}}'
        );

        // drops foreign key for table `{{%ingredients}}`
        $this->dropForeignKey(
            '{{%fk-items_ingredients-ingredient_id}}',
            '{{%items_ingredients}}'
        );

        // drops index for column `ingredient_id`
        $this->dropIndex(
            '{{%idx-items_ingredients-ingredient_id}}',
            '{{%items_ingredients}}'
        );

        $this->dropTable('{{%items_ingredients}}');
    }
}
