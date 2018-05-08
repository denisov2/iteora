<?php


/* @var $dishes app\models\Dish[] */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;



?>

<?php if (empty($dishes)) { ?>

    <div class="panel panel-danger">
        <div class="panel-heading">Нет блюд </div>
        <div class="panel-body">
            Выбирите достаточное количество продуктов
        </div>
    </div>

<?php } else {

    foreach ($dishes as $dish) {
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading"><?=$dish->name?></div>
            <div class="panel-body">
               <?=$dish->getProductsText()?>

                <button data-id="<?=$dish->id?>" class="btn btn-default order" onclick="orderDish(<?=$dish->id?>)">Заказать</button>
            </div>
        </div>

    <?php }
} ?>

