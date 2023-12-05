<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%food_orders}}`
 * - `{{%user}}`
 * - `{{%restaurants}}`
 */
class m231107_213631_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'food_order_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'stars' => $this->decimal(1,1)->notNull(),
            'description' => $this->text(),
        ],'ENGINE=InnoDB');

        // creates index for column `food_order_id`
        $this->createIndex(
            '{{%idx-reviews-food_order_id}}',
            '{{%reviews}}',
            'food_order_id'
        );

        // add foreign key for table `{{%food_orders}}`
        $this->addForeignKey(
            '{{%fk-reviews-food_order_id}}',
            '{{%reviews}}',
            'food_order_id',
            '{{%food_orders}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-reviews-user_id}}',
            '{{%reviews}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-reviews-user_id}}',
            '{{%reviews}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `restaurant_id`
        $this->createIndex(
            '{{%idx-reviews-restaurant_id}}',
            '{{%reviews}}',
            'restaurant_id'
        );

        // add foreign key for table `{{%restaurants}}`
        $this->addForeignKey(
            '{{%fk-reviews-restaurant_id}}',
            '{{%reviews}}',
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
        // drops foreign key for table `{{%food_orders}}`
        $this->dropForeignKey(
            '{{%fk-reviews-food_order_id}}',
            '{{%reviews}}'
        );

        // drops index for column `food_order_id`
        $this->dropIndex(
            '{{%idx-reviews-food_order_id}}',
            '{{%reviews}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-reviews-user_id}}',
            '{{%reviews}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-reviews-user_id}}',
            '{{%reviews}}'
        );

        // drops foreign key for table `{{%restaurants}}`
        $this->dropForeignKey(
            '{{%fk-reviews-restaurant_id}}',
            '{{%reviews}}'
        );

        // drops index for column `restaurant_id`
        $this->dropIndex(
            '{{%idx-reviews-restaurant_id}}',
            '{{%reviews}}'
        );

        $this->dropTable('{{%reviews}}');
    }
}
