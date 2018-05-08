<?php

/* @var $this yii\web\View */

$this->title = 'Подбор продуктов';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Подбор продуктов</h2>
                <?= \app\widgets\Products::widget() ?>
            </div>
            <div class="col-lg-4">
                <h2>Подходящие блюда</h2>
                <div class="dishes-wrapper">
                 <?= $this->render('_dishes', [
                     'dishes' => []
                 ])?>
                </div>
            </div>
            <div class="col-lg-4">
                <h2 class="queue-header">Очередь приготовления</h2>
                <div class="queue-wrapper">
                    <?= $this->render('_queue')?>
                </div>
                <p><a id="btn-clear-order" class="btn btn-default " href="#">Очистить очередь</a></p>
            </div>
        </div>

    </div>
</div>
