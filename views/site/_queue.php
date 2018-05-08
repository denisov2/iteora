<?php


/* @var $dishes app\models\Dish[] */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\Queue;

$queues = Queue::find()->where(['session_id' => Yii::$app->session->id])->all();

?>

<?foreach ($queues as $queue) { 
    /* @var $queue Queue */
    $dish = $queue->dish;
    ?>
<h5>Ваше блюдо "<?=$dish->name?>" в процессе приготовления </h5>
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$queue->getPercent()?>%;">
        <?=$queue->getPercent()?>%
    </div>
</div>
<?php } ?>