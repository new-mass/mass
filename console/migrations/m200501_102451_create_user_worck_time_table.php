<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_worck_time}}`.
 */
class m200501_102451_create_user_worck_time_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_worck_time}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->smallInteger(),
            'from' => $this->smallInteger(2),
            'to' => $this->smallInteger(2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_worck_time}}');
    }
}
