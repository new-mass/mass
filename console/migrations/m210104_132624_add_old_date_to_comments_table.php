<?php

use yii\db\Migration;

/**
 * Class m210104_132624_add_old_date_to_comments_table
 */
class m210104_132624_add_old_date_to_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'old_date', $this->string(12));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comments', 'old_date');
    }

}
