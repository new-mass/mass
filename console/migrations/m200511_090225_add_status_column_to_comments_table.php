<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%comments}}`.
 */
class m200511_090225_add_status_column_to_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'status', $this->integer(1)->comment('0 на модерации, 1 публикуется, 2 скрыт')->unsigned()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comments', 'status');
    }
}
