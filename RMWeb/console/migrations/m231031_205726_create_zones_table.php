<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%zones}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%Restaurants}}`
 */
class m231031_205726_create_zones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%zones}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'description' => $this->string(200),
            'restaurant_id' => $this->integer()->notNull(),
            'capacity' => $this->integer()->notNull(),
        ],'ENGINE=InnoDB');

        // creates index for column `RestaurantID`
        $this->createIndex(
            '{{%idx-zones-restaurant_id}}',
            '{{%zones}}',
            'restaurant_id'
        );

        // add foreign key for table `{{%Restaurants}}`
        $this->addForeignKey(
            '{{%fk-zones-restaurant_id}}',
            '{{%zones}}',
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
        // drops foreign key for table `{{%Restaurants}}`
        $this->dropForeignKey(
            '{{%fk-zones-restaurant_id}}',
            '{{%zones}}'
        );

        // drops index for column `RestaurantID`
        $this->dropIndex(
            '{{%idx-zones-restaurant_id}}',
            '{{%zones}}'
        );

        $this->dropTable('{{%zones}}');
    }
}
