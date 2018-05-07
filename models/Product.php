<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
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
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'alias'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return array
     */
    public static function getList() {

        return ArrayHelper::map( self::find()->select('id, name')->all(), 'id', 'name' );
    }
}
