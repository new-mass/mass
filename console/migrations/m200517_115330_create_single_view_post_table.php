<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%single_view_post}}`.
 */
class m200517_115330_create_single_view_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%single_view_post}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'count' => $this->integer()->defaultValue(0)->unsigned(),
        ]);

        $this->addForeignKey('fk-single_view_post-posts-id', 'single_view_post', 'post_id', 'posts', 'id', 'CASCADE');
    }

/**
 * {@inheritdoc}
 */
public function safeDown()
{
    $this->dropTable('{{%single_view_post}}');
}
}
