<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%service}}`.
 */
class m211219_091107_add_status_column_to_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('service', 'status', $this->tinyInteger()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('service', 'status');
    }
}
