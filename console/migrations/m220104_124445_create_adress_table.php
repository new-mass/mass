<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%adress}}`.
 */
class m220104_124445_create_adress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adress}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'x' => $this->float(),
            'y' => $this->float(),
            'adress' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%adress}}');
    }
}
