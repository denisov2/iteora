<?php
namespace app\widgets;



use app\models\Product;
use kartik\checkbox\CheckboxX;
use yii\base\Widget;

/**
 * Class Products
 * @package app\widgets
 */
class Products extends Widget
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $products = Product::find()->all();

        foreach ($products as $product) { ?>


            <?= CheckboxX::widget([
                'name'=>'product_'.$product->id,
                'options' => [
                    'id'=>'product_'.$product->id,
                    'class' => 'product-checkbox',
                ],
                'pluginOptions'=>[
                    'threeState'=>false,
                    'size'=>'sm',
                    "change"=>"function() {
                        console.log('change'); 
                     }",
                ],
                'pluginEvents'=>[
                    "change"=>"updateDishes",
                ],
            ]);
            ?>
            <label class="cbx-label" for="product_<?= $product->id ?>">
                <?= $product->name ?>
            </label>
            <br>
        <? }

    }
}
