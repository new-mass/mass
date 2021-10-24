<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_balance_notification}}`.
 */
class m211011_153510_create_user_balance_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_balance_notification}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'last_notification_send' => $this->integer(),
            'is_send_notification' => $this
                ->tinyInteger()
                ->defaultValue(1)
                ->comment('0 не отправлять 1 отправлять'),
            'balance_event' => $this->smallInteger()->unsigned()->defaultValue(50),
        ]);

        $this->addForeignKey('fk-user-balance-notification_id-user-id', 'user_balance_notification', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_balance_notification}}');
    }
}
