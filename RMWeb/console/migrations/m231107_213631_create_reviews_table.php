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
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'stars' => $this->integer()->notNull(),
            'description' => $this->text(),
        ],'ENGINE=InnoDB');

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
