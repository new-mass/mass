<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comfort}}`.
 */
class m200503_145413_create_comfort_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comfort}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);
        $this->execute('
        INSERT INTO `comfort` (`value`) VALUES
            ( \'массажный стол\'),
            ( \'татами\'),
            ( \'натуральные масла\'),
            ( \'масла без запаха\'),
            ( \'одноразовые принадлежности\'),
            ( \'благовония\'),
            ( \'кондиционер\'),
            ( \'бесплатная парковка\'),
            ( \'музыка\'),
            ( \'чай\'),
            ( \'кофе\'),
            ( \'прохладительные напитки\'),
            ( \'душ\'),
            ( \'ванна\'),
            ( \'джакузи\'),
            ( \'кедровая бочка\'),
            ( \'сауна\');
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comfort}}');
    }
}
