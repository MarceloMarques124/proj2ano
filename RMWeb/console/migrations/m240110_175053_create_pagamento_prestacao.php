<?php

use yii\db\Migration;

/**
 * Class m240110_175053_create_pagamento_prestacao
 *  * - `{{%order}}`
 * - `{{%user}}`
 */

class m240110_175053_create_pagamento_prestacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prestacoes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'montante' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
            'data' => $this->dateTime(),

        ], 'ENGINE=InnoDB');

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-prestacoes-user_id}}',
            '{{%prestacoes}}',
            'user_id'
        );
        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-prestacoes-user_id}}',
            '{{%prestacoes}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-prestacoes-order_id}}',
            '{{%prestacoes}}',
            'user_id'
        );
        // add foreign key for table `{{%order}}`
        $this->addForeignKey(
            '{{%fk-prestacoes-order_id}}',
            '{{%prestacoes}}',
            'user_id',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-prestacoes-user_id}}',
            '{{%prestacoes}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-prestacoes-user_id}}',
            '{{%prestacoes}}'
        );

        // drops foreign key for table `{{%order}}`
        $this->dropForeignKey(
            '{{%fk-prestacoes-user_id}}',
            '{{%prestacoes}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-prestacoes-user_id}}',
            '{{%prestacoes}}'
        );

        $this->dropTable('{{%prestacoes}}');
    }
}
