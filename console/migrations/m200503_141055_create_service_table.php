<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 */
class m200503_141055_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(40),
            'value' => $this->string(40),
        ]);
        $this->execute('
        
        INSERT INTO `service` (`value`, `url`) VALUES
( \'Аква-пенный массаж\', \'akva-pennyy\'),
( \'Антицеллюлитный массаж\', \'anticellyulitnyy-massagh\'),
( \'Баночный массаж\', \'banochnyy\'),
( \'Боди массаж\', \'bodi-massagh\'),
( \'Массаж ветка сакуры\', \'vetka-sakury\'),
( \'Восточный массаж\', \'vostochnyy\'),
( \'Египетский массаж\', \'egipetskiy\'),
( \'Классический массаж\', \'klassicheskiy\'),
( \'Криомассаж\', \'kriomassagh\'),
( \'Лечебный массаж\', \'lechebnyy\'),
( \'Массаж головы\', \'massagh-golovy\'),
( \'Массаж груди\', \'massagh-grudi\'),
( \'Массаж лица\', \'massagh-lica\'),
( \'Массаж ложками\', \'massagh-loghkami\'),
( \'Массаж ног\', \'massagh-nog\'),
( \'Массаж простаты\', \'massagh-prostaty\'),
( \'Массаж спины\', \'massagh-spiny\'),
( \'Обертывание\', \'obertyvanie\'),
( \'Стоун-массаж\', \'stoun-massagh\'),
( \'Тайский массаж\', \'tayskiy\'),
( \'Тантрический массаж\', \'tantricheskiy\'),
( \'Точечный массаж\', \'tochechnyy\'),
( \'Турецкий массаж\', \'tureckiy\'),
( \'Шведский массаж\', \'shvedskiy\'),
( \'Эротический массаж\', \'eroticheskiy\'),
( \'Японский массаж\', \'yaponskiy\'),
( \'Китайский массаж \', \'kitaiskyi\'),
( \'Массаж лингама\', \'massagh-lingama\'),
( \'Аппаратный массаж\', \'apparatnyy-massagh\'),
( \'Гигиенический массаж\', \'gigienicheskiy-massagh\'),
( \'Косметический массаж\', \'kosmeticheskiy-massagh\'),
( \'Лимфодренажный массаж\', \'limfodrenaghnyy-massagh\'),
( \'Массаж рук\', \'massagh-ruk\'),
( \'Расслабляющий массаж\', \'rasslablyayuschiy-massagh\'),
( \'Спортивный массаж\', \'sportivnyy-massagh\'),
( \'Массаж в четыре руки\', \'massagh-v-chetyre-ruki\'),
( \'Массаж стоп\', \'massagh-stop\'),
( \'Медовый массаж\', \'medovyy-massagh\'),
( \'Пилинг\', \'piling\'),
( \'Урологический массаж\', \'urologicheskiy-massagh\'),
( \'Фут-массаж\', \'fut-massagh\'),
( \'Реанимационный массаж\', \'reanimacionnyy-massagh\'),
( \'Гинекологический массаж\', \'ginekologicheskiy-massagh\'),
( \'Колон-массаж\', \'kolon-massagh\'),
( \'Массаж ногами\', \'massagh-nogami\'),
( \'lpg массаж\', \'lpg-massagh\'),
( \'Массаж живота\', \'massagh-ghivota\'),
( \'Массаж шеи\', \'massagh-shei\'),
( \'Массаж асахи\', \'massagh-asahi\'),
( \'Массаж гуаша\', \'massagh-guasha\');
        
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%service}}');
    }
}
