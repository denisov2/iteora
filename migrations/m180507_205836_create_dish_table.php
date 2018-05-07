<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dish`.
 */
class m180507_205836_create_dish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dish', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'time' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('dish');
    }
}
