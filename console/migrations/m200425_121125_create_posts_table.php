<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m200425_121125_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->smallInteger()->unsigned(),
            'user_id' => $this->smallInteger()->unsigned(),
            'tarif_id' => $this->smallInteger(2)->unsigned(),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
            'sorting' => $this->integer()->unsigned(),
            'name' => $this->string(80),
            'phone' => $this->string(20),
            'work_time' => $this->smallInteger(3)->unsigned(),
            'age' => $this->smallInteger(3)->unsigned(),
            'breast' => $this->smallInteger(3)->unsigned(),
            'ves' => $this->smallInteger(3)->unsigned(),
            'rost' => $this->smallInteger(3)->unsigned(),
            'price' => $this->smallInteger(6)->unsigned(),
            'price_2_hour' => $this->smallInteger(6)->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
