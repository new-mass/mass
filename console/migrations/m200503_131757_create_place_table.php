<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place}}`.
 */
class m200503_131757_create_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%place}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(40),
            'value' => $this->string(40),
        ]);
        $this->execute('
        INSERT INTO `place` (`url`, `value`) VALUES
                ( \'appartamentu\', \'На дому\'),
                ( \'viezd\', \'На выезд\');
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%place}}');
    }
}
