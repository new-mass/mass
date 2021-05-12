<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%posts}}`.
 */
class m210509_113422_add_dop_sort_column_to_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'video_sort', $this->tinyInteger(1)->defaultValue(0)
            ->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('posts', 'dop_sort');
    }
}
