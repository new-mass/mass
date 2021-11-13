<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reqest_call}}`.
 */
class m211111_161824_create_reqest_call_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_call}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'post_id' => $this->integer(),
            'user_id' => $this->integer(),
            'text' => $this->string(),
            'phone' => $this->string(),
            'status' => $this->tinyInteger()
                ->defaultValue(0)
                ->comment('0 заявка не просмотрена, 1 просмотрена, 2 заявка скрыта'),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_call}}');
    }
}
