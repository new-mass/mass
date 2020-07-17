<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%comments}}`.
 */
class m200511_115854_add_create_at_column_to_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'created_at', $this->integer());
        $this->addColumn('comments', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comments', 'created_at');
        $this->dropColumn('comments', 'updated_at');
    }
}
