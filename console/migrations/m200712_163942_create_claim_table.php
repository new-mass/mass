<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%claim}}`.
 */
class m200712_163942_create_claim_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%claim}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
            'email' => $this->string(52),
            'text' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%claim}}');
    }
}
