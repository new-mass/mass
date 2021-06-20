<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reason_claim}}`.
 */
class m210619_131123_create_reason_claim_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reason_claim}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(),
        ]);

        $this->execute('INSERT INTO `reason_claim` ( `value` ) VALUES ("Телефон отключён") , 
                                               ("Не берут трубку") , 
                                               ("Цена не соответствует") , 
                                               ("Ошиблись номером") , 
                                               ("Грубо общается" ),
                                               ("Фото не её"),
                                               ("Другое") ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reason_claim}}');
    }
}
