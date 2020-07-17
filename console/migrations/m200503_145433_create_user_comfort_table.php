<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_comfort}}`.
 */
class m200503_145433_create_user_comfort_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_comfort}}', [
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
        $this->dropTable('{{%user_comfort}}');
    }
}
