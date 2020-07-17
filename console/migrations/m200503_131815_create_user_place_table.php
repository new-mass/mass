<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_place}}`.
 */
class m200503_131815_create_user_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_place}}', [
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
        $this->dropTable('{{%user_place}}');
    }
}
