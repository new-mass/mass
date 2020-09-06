<?php

use yii\db\Migration;

/**
 * Class m200906_134553_add_old_id_to_comments_table
 */
class m200906_134553_add_old_id_to_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'old_id', $this->smallInteger()->unsigned()->comment('ид из старого сайта'));
        $this->addColumn('comments', 'city_id', $this->smallInteger()->unsigned()->comment('город из старого сайта'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comments', 'old_id');
        $this->dropColumn('comments', 'city_id');
    }
}
