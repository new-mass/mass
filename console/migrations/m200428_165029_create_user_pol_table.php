<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_pol}}`.
 */
class m200428_165029_create_user_pol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_pol}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->smallInteger()->unsigned(),
            'pol_id' => $this->smallInteger(1)->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_pol}}');
    }
}
