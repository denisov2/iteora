<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dish_product`.
 * Has foreign keys to the tables:
 *
 * - `dish`
 * - `product`
 */
class m180507_212232_create_junction_table_for_dish_and_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dish_product', [
            'dish_id' => $this->integer(),
            'product_id' => $this->integer(),
            'PRIMARY KEY(dish_id, product_id)',
        ]);

        // creates index for column `dish_id`
        $this->createIndex(
            'idx-dish_product-dish_id',
            'dish_product',
            'dish_id'
        );

        // add foreign key for table `dish`
        $this->addForeignKey(
            'fk-dish_product-dish_id',
            'dish_product',
            'dish_id',
            'dish',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-dish_product-product_id',
            'dish_product',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-dish_product-product_id',
            'dish_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `dish`
        $this->dropForeignKey(
            'fk-dish_product-dish_id',
            'dish_product'
        );

        // drops index for column `dish_id`
        $this->dropIndex(
            'idx-dish_product-dish_id',
            'dish_product'
        );

        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-dish_product-product_id',
            'dish_product'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-dish_product-product_id',
            'dish_product'
        );

        $this->dropTable('dish_product');
    }
}
