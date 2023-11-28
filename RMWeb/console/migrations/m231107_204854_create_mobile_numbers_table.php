<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mobile_numbers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m231107_204854_create_mobile_numbers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mobile_numbers}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'mobile_number' => $this->string(20)->notNull(),
            'description' => $this->string(50),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-mobile_numbers-user_id}}',
            '{{%mobile_numbers}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-mobile_numbers-user_id}}',
            '{{%mobile_numbers}}',
            'user_id',
            '{{%user}}',
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
            '{{%fk-mobile_numbers-user_id}}',
            '{{%mobile_numbers}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-mobile_numbers-user_id}}',
            '{{%mobile_numbers}}'
        );

        $this->dropTable('{{%mobile_numbers}}');
    }
}
