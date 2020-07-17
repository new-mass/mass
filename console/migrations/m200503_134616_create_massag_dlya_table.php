<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%massag_dlya}}`.
 */
class m200503_134616_create_massag_dlya_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%massag_dlya}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(40),
            'value' => $this->string(40),
        ]);

        $this->execute('
        INSERT INTO `massag_dlya` ( `url`, `value`) VALUES
                ( \'muzhchin\', \'мужчин\'),
                ( \'zhenshchin\', \'женщин\'),
                ( \'par\', \'пар\');
        ');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%massag_dlya}}');
    }
}
