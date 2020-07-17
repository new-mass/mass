<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_view}}`.
 */
class m200505_134735_create_post_view_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_view}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'count' => $this->integer()->defaultValue(0)->unsigned(),
        ]);

        $this->addForeignKey('fk-post_view-posts-id', 'post_view', 'post_id', 'posts', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post_view}}');
    }
}
