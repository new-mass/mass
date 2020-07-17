<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tarif}}`.
 */
class m200426_092023_create_tarif_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tarif}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'value' => $this->smallInteger(2),
        ]);

        $this->execute('
        INSERT INTO `tarif` ( `name`, `value`) VALUES
                            ( \'Начальный\', 1),
                            ( \'VIP\', 2),
                            ( \'TOP\', 3),
                            ( \'TOP+\', 4),
                            ( \'Premium\', 5),
                            ( \'Extra\', 6),
                            ( \'Бесплатный\', 0);
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tarif}}');
    }
}
