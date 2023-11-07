<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_items_ingredients}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%food_items}}`
 * - `{{%ingredients}}`
 */
class m231107_201638_create_junction_table_for_food_items_and_ingredients_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_items_ingredients}}', [
            'food_items_id' => $this->integer(),
            'ingredients_id' => $this->integer(),
            'used_quantity' => $this->decimal(4,2)->notNull(),
            'PRIMARY KEY(food_items_id, ingredients_id)',
        ]);

        // creates index for column `food_items_id`
        $this->createIndex(
            '{{%idx-food_items_ingredients-food_items_id}}',
            '{{%food_items_ingredients}}',
            'food_items_id'
        );

        // add foreign key for table `{{%food_items}}`
        $this->addForeignKey(
            '{{%fk-food_items_ingredients-food_items_id}}',
            '{{%food_items_ingredients}}',
            'food_items_id',
            '{{%food_items}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ingredients_id`
        $this->createIndex(
            '{{%idx-food_items_ingredients-ingredients_id}}',
            '{{%food_items_ingredients}}',
            'ingredients_id'
        );

        // add foreign key for table `{{%ingredients}}`
        $this->addForeignKey(
            '{{%fk-food_items_ingredients-ingredients_id}}',
            '{{%food_items_ingredients}}',
            'ingredients_id',
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
            '{{%fk-food_items_ingredients-food_items_id}}',
            '{{%food_items_ingredients}}'
        );

        // drops index for column `food_items_id`
        $this->dropIndex(
            '{{%idx-food_items_ingredients-food_items_id}}',
            '{{%food_items_ingredients}}'
        );

        // drops foreign key for table `{{%ingredients}}`
        $this->dropForeignKey(
            '{{%fk-food_items_ingredients-ingredients_id}}',
            '{{%food_items_ingredients}}'
        );

        // drops index for column `ingredients_id`
        $this->dropIndex(
            '{{%idx-food_items_ingredients-ingredients_id}}',
            '{{%food_items_ingredients}}'
        );

        $this->dropTable('{{%food_items_ingredients}}');
    }
}
