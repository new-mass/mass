<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_massag_dlya}}`.
 */
class m200503_134645_create_user_massag_dlya_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_massag_dlya}}', [
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
        $this->dropTable('{{%user_massag_dlya}}');
    }
}
