<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m200718_124017_add_old_pass_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'old_pass', $this->string(40)->comment('Пароль со старого сайта'));
        $this->execute('DROP INDEX username on user ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'old_pass');
    }
}
