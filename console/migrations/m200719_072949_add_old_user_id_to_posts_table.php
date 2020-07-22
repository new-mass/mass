<?php

use yii\db\Migration;

/**
 * Class m200719_072949_add_old_user_id_to_posts_table
 */
class m200719_072949_add_old_user_id_to_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'old_user_id', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('posts', 'old_user_id');
    }

}
