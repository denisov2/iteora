<?php
namespace app\widgets;



use app\models\Product;

class Products extends \yii\bootstrap\Widget
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $products = Product::findAll();
        foreach ($products as $product) { ?>
            <label for="<?= $product->id ?>"><?= $product->name ?></label>
            <input type="checkbox"  name="<?= $product->id ?>" value="<?= $product->name ?>" />  
        <? }

    }
}
