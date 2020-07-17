<?php

use yii\db\Migration;

/**
 * Class m200519_170435_add_pay_time_to_posts_table
 */
class m200519_170435_add_pay_time_to_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'pay_time', $this->integer()->unsigned()->comment('Время до каторого анкета оплачена')->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('posts', 'pay_time');
    }

}
