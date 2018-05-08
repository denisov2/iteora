<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "queue".
 *
 * @property int $id
 * @property string $session_id
 * @property int $dish_id
 * @property int $start
 */
class Queue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'dish_id'], 'required'],
            [['dish_id', 'start'], 'integer'],
            [['session_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Session ID',
            'dish_id' => 'Dish ID',
            'start' => 'Start',
        ];
    }

    /**
     * @param $dish_id
     */
    public static function add($dish_id)
    {
        $session_id = Yii::$app->session->id;
        $count = self::find()->where(['session_id' => $session_id])->count();
        if($count >=2) return false;

        $queue = new Queue([
            'dish_id' => $dish_id,
            'session_id' => $session_id,
            'start' => time(),
        ]);
        $queue->save();
    }
}
