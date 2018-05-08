<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dish`.
 */
class m180507_230016_create_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('queue', [
            'id' => $this->primaryKey(),
            'session_id' => $this->string()->notNull(),
            'dish_id' => $this->integer()->notNull(),
            'start' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('queue');
    }
}
