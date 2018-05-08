<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "queue".
 *
 * @property int $id
 * @property string $session_id
 * @property int $dish_id
 * @property Dish $dish
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
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['id' => 'dish_id']);
    }

    /**
     * @return float|int
     */
    public function getPercent() {
        
        $start_time = $this->start;
        $now_diff =  time() - $start_time;
        $max_diff = $this->dish->time * 60;

        $result = !empty($max_diff) ? round ($now_diff / $max_diff * 100 ) : 0;
        if($result > 100) $result = 100;

        
        return $result;
    }


    /**
     * @param $dish_id
     * @return Queue|bool
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
        if($queue->save()) return $queue;

        return false;

    }

    /**
     * @param $session_id
     * @return int
     * @throws \Exception
     * @throws \Throwable
     */
    public static function check($session_id)
    {
        $deleted = 0;
        $queues = self::find()->where(['session_id' => $session_id])->all();
        foreach ($queues as $queue) {
            
            /* @var $queue Queue */
            
            if($queue->getPercent() >= 100) {
                
                if($queue->delete()) $deleted  = 1;
            }
        }        
        
        return $deleted;
    }
}
