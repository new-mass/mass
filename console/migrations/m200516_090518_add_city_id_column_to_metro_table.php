<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%metro}}`.
 */
class m200516_090518_add_city_id_column_to_metro_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('metro', 'city_id', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('metro', 'city_id');
    }
}
