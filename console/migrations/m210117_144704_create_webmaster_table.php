<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webmaster}}`.
 */
class m210117_144704_create_webmaster_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%webmaster}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->tinyInteger()->unsigned(),
            'tag' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%webmaster}}');
    }
}
