<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%check_photo_request}}`.
 */
class m210629_152606_create_check_photo_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%check_photo_request}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->integer()->defaultValue(0)->comment('0 заявка новая 1 заявка просмотрена'),
        ]);

        $this->addForeignKey('fk-check_photo_request_post_id_posts_id', 'check_photo_request', 'post_id',
            'posts', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%check_photo_request}}');
    }
}
