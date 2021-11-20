<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m211118_163116_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer()->unsigned(),
            'from' => $this->integer()->unsigned(),
            'to' => $this->integer()->unsigned(),
            'message' => $this->text(),
            'post_id' => $this->integer(),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
            'status' => $this->smallInteger()->comment('Отражает состояние сообщения, прочитано или нет'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message}}');
    }
}
