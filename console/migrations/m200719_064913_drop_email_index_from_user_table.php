<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%email_index_from_user}}`.
 */
class m200719_064913_drop_email_index_from_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('email', 'user');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'email', $this->string()->unique());
    }
}
