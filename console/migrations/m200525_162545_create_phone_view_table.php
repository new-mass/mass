<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone_view}}`.
 */
class m200525_162545_create_phone_view_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phone_view}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'count' => $this->integer()->defaultValue(0)->unsigned(),
        ]);

        $this->addForeignKey('fk-phone_view_post-posts-id', 'phone_view', 'post_id', 'posts', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%phone_view}}');
    }
}
