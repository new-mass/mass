<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_rayon}}`.
 */
class m200503_143215_create_user_rayon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_rayon}}', [
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
        $this->dropTable('{{%user_rayon}}');
    }
}
