<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m200511_153919_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey()->unsigned(),
            'value' => $this->string(50),
            'name' => $this->string(50),
        ]);
        
        $this->execute('
        INSERT INTO `city` ( `value`, `name`) VALUES
                            ( \'Москва\', \'moskva\'),
                            ( \'Королев\', \'korolev\'),
                            ( \'Химки\', \'himki\'),
                            ( \'Санкт-Петербург\', \'spb\'),
                            ( \'Нижний-новгород\', \'nighniy-novgorod\'),
                            ( \'Воронеж\', \'voronegh\'),
                            ( \'Ростов-на-Дону\', \'rostov-na-donu\'),
                            ( \'Краснодар\', \'krasnodar\'),
                            ( \'Казань\', \'kazany\'),
                            ( \'Екатеринбург\', \'ekaterinburg\'),
                            ( \'Волгоград\', \'volgograd\'),
                            ( \'Самара\', \'samara\'),
                            ( \'Уфа\', \'ufa\'),
                            ( \'Омск\', \'omsk\');
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
