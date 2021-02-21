<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messanger}}`.
 */
class m210209_172807_create_messanger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%messanger}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(25),
            'img' => $this->string(45),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%messanger}}');
    }
}
