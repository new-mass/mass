<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m200509_073403_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey()->unsigned(),
            'parent_id' => $this->integer()->unsigned(),
            'post_id' => $this->integer(),
            'name' => $this->string(25),
            'text' => $this->string(255),
            'mark' => $this->smallInteger(1)->unsigned(),
        ]);

        $this->addForeignKey('fk-post_comment-posts-id', 'comments', 'post_id', 'posts', 'id', 'CASCADE');
        $this->addForeignKey('fk-comment_id-parrent-comment-id', 'comments', 'parent_id', 'comments', 'id', 'CASCADE');

    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
