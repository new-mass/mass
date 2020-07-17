<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hystory}}`.
 */
class m200519_160812_create_hystory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hystory}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->smallInteger()->unsigned(),
            'type' => $this->string(),
            'timestamp' => $this->integer()->unsigned(),
            'balance' => $this->smallInteger()->unsigned()->comment('Остаток на счете'),
            'sum' => $this->smallInteger()->unsigned()->comment('Сумма списания'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hystory}}');
    }
}
