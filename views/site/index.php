<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Подбор продуктов</h2>


                <?= \app\widgets\Products::widget() ?>



                <p><a id="cancel-product-list" class="btn btn-default" href="#">Отменить все</a></p>
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
                <h2>Очередь приготовления</h2>

                <div class="queue">
                    <?=Yii::$app->session->id?>
                    <h5>«Ваше блюдо X в процессе приготовления» </h5>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            60%
                        </div>
                    </div>



                </div>

                <p><a class="btn btn-default" href="#">Очистить очередь</a></p>
            </div>
        </div>

    </div>
</div>
