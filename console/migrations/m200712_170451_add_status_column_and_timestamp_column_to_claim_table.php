<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%claim}}`.
 */
class m200712_170451_add_status_column_and_timestamp_column_to_claim_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('claim', 'status', $this->integer(1)->defaultValue(0));
        $this->addColumn('claim', 'timestamp', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('claim', 'status');
        $this->dropColumn('claim', 'timestamp');
    }
}
