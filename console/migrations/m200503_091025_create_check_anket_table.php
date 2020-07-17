<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%check_anket}}`.
 */
class m200503_091025_create_check_anket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%check_anket}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(255),
        ]);

        $this->execute( 'INSERT INTO `check_anket` ( `value`) VALUES
                (\'Могу подтвердить личность по видео связи с клиентом\'),
                (\'Могу выслать проверочные фото клиенту\')');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%check_anket}}');
    }
}
