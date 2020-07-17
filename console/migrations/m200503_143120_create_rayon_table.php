<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rayon}}`.
 */
class m200503_143120_create_rayon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rayon}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(40),
            'value' => $this->string(40),
            'city_id' => $this->smallInteger(2)->unsigned(),
        ]);
        
        $this->execute('
        INSERT INTO `rayon` ( `url`, `value`) VALUES
            ( \'bolshevo\', \'Болшево\'),
            ( \'oboldino\', \'Оболдино\'),
            ( \'pervomayskiy\', \'Первомайский\'),
            ( \'tekstilyschik\', \'Текстильщик\'),
            ( \'torfopredpriyatie\', \'Торфопредприятие\'),
            ( \'-yubileynyy\', \' Юбилейный\');
        ');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rayon}}');
    }
}
