<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%anket_claim}}`.
 */
class m210619_131247_create_anket_claim_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%anket_claim}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'reason_id' => $this->integer(),
            'text' => $this->string(),
            'created_at' =>  $this->integer()->unsigned(),
            'updated_at' =>  $this->integer()->unsigned(),
        ]);

        $this->addForeignKey('fk-anket_claim_reason_id_reason_claim_id', 'anket_claim', 'reason_id',
            'reason_claim', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('fk-anket_claim_post_id_posts_id', 'anket_claim', 'post_id',
            'posts', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%anket_claim}}');
    }
}
