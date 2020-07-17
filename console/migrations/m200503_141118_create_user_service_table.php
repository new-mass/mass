<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_service}}`.
 */
class m200503_141118_create_user_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_service}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->smallInteger()->unsigned(),
            'prop_id' => $this->smallInteger()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_service}}');
    }
}
