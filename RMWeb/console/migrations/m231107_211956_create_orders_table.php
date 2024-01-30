<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_orders}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%restaurants}}`
 * - `{{%tables}}`
 */
class m231107_211956_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'price' => $this->decimal(4, 2)->notNull(),
            'state' => $this->getDb()->getSchema()->createColumnSchemaBuilder("ENUM('payment', 'paid', 'completed')")->notNull(),
        ],'ENGINE=InnoDB');

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-orders-user_id}}',
            '{{%orders}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-orders-user_id}}',
            '{{%orders}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `restaurant_id`
        $this->createIndex(
            '{{%idx-orders-restaurant_id}}',
            '{{%orders}}',
            'restaurant_id'
        );

        // add foreign key for table `{{%restaurants}}`
        $this->addForeignKey(
            '{{%fk-orders-restaurant_id}}',
            '{{%orders}}',
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
            '{{%fk-orders-user_id}}',
            '{{%orders}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-orders-user_id}}',
            '{{%orders}}'
        );

        // drops foreign key for table `{{%restaurants}}`
        $this->dropForeignKey(
            '{{%fk-orders-restaurant_id}}',
            '{{%orders}}'
        );

        // drops index for column `restaurant_id`
        $this->dropIndex(
            '{{%idx-orders-restaurant_id}}',
            '{{%orders}}'
        );

        $this->dropTable('{{%orders}}');
    }
}
