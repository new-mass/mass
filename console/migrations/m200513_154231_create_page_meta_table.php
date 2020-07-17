<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_meta}}`.
 */
class m200513_154231_create_page_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page_meta}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->smallInteger(1)->unsigned(),
            'page_name' => $this->string(100),
            'title' => $this->string(150),
            'des' => $this->string(255),
            'h1' => $this->string(128),
            'h2' => $this->string(128),
            'text' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page_meta}}');
    }
}
