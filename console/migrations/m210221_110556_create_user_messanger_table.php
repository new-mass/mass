<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_messanger}}`.
 */
class m210221_110556_create_user_messanger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_messanger}}', [
            'prop_id' => $this->tinyInteger()->unsigned(),
            'user_id'      => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_messanger}}');
    }
}
