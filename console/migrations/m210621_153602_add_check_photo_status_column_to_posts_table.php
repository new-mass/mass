<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%posts}}`.
 */
class m210621_153602_add_check_photo_status_column_to_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'check_photo_status', $this->tinyInteger()
            ->defaultValue(0)
            ->comment('0 фото не проверенно 1 проверенно')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('posts', 'check_photo_status');
    }
}
