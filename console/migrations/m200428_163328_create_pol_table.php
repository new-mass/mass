<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pol}}`.
 */
class m200428_163328_create_pol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pol}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);
        $this->execute('
        INSERT INTO `pol` ( `url`, `value`) VALUES
                (\'man\', \'Мужской\'),
                (\'woman\', \'Женский\')
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pol}}');
    }
}
