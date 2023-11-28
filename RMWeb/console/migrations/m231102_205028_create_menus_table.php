<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menus}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%restaurants}}`
 */
class m231102_205028_create_menus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menus}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'price' => $this->decimal(4,2)->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
        ],'ENGINE=InnoDB');

        // creates index for column `restaurant_id`
        $this->createIndex(
            '{{%idx-menus-restaurant_id}}',
            '{{%menus}}',
            'restaurant_id'
        );

        // add foreign key for table `{{%restaurants}}`
        $this->addForeignKey(
            '{{%fk-menus-restaurant_id}}',
            '{{%menus}}',
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
        // drops foreign key for table `{{%restaurants}}`
        $this->dropForeignKey(
            '{{%fk-menus-restaurant_id}}',
            '{{%menus}}'
        );

        // drops index for column `restaurant_id`
        $this->dropIndex(
            '{{%idx-menus-restaurant_id}}',
            '{{%menus}}'
        );

        $this->dropTable('{{%menus}}');
    }
}
