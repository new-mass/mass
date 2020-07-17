<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_check_anket}}`.
 */
class m200503_111800_create_user_check_anket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_check_anket}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->smallInteger()->unsigned(),
            'prop_id' => $this->integer()->comment('ид способа проверки'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_check_anket}}');
    }
}
