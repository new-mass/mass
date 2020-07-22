<?php

use yii\db\Migration;

/**
 * Class m200718_120028_add_rostov_rayon
 */
class m200718_120028_add_rostov_rayon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        INSERT INTO `rayon` (`url`, `value`, `city_id`) VALUES
                ( \'voroshilovskiy\', \'Ворошиловский\', "7"),
                ( \'gheleznodoroghnyy\', \'Железнодорожный\', "7"),
                ( \'kirovskiy\', \'Кировский\', "7"),
                ( \'leninskiy\', \'Ленинский\', "7"),
                ( \'oktyabryskiy\', \'Октябрьский\', "7"),
                ( \'pervomayskiy\', \'Первомайский\', "7"),
                ( \'proletarskiy\', \'Пролетарский\', "7"),
                ( \'sovetskiy\', \'Советский\', "7");
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('
         DELETE FROM `rayon` WHERE `city_id` = 7
        ');

        return false;
    }

}
