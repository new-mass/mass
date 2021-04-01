<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photo}}`.
 */
class m210307_104913_add_type_column_to_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('photo', 'type', $this->tinyInteger()->unsigned()
            ->comment('0 photo type, 1 video type')->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('photo', 'type');
    }
}
