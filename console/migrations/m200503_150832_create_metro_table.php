<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metro}}`.
 */
class m200503_150832_create_metro_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%metro}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(40),
            'value' => $this->string(40),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metro}}');
    }
}
