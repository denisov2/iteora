<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "dish".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property int $time
 * @property Product[] $products
 */
class Dish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'time'], 'required'],
            [['time'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'slugAttribute' => 'alias',
            ],
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'alias' => 'Alias',
            'time' => 'Time',
        ];
    }
    
    /**
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->viaTable('dish_product', ['dish_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getProductsText()
    {
        $products = $this->getProducts()->select('name')->column();
        return implode(',' , $products);
            
    }




    /**
     * @param array $productIds
     * @return bool
     */
    public function updateProducts(array $productIds)
    {
        DishProduct::deleteAll(['dish_id' => $this->id]);
        foreach ($productIds as $productId) {
            
            $dishProduct = new DishProduct([
                'dish_id' => $this->id,
                'product_id' => $productId,
            ]);
            $dishProduct->save();
        }
        
        return true;
    }


}
