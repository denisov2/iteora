<?php

namespace app\controllers;

use app\models\Dish;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;


/**
 * Class SiteController
 * @package app\controllers
 */
class AjaxController extends Controller
{

    /**
     * @return array
     */
    public function actionUpdateDishes()
    {
        if (!\Yii::$app->request->isAjax || !\Yii::$app->request->isPost) throw new ForbiddenHttpException();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $checkbox_ids = \Yii::$app->request->post('checkbox_ids');
        $product_ids = [];
        $dishes = [];

        if(!empty($checkbox_ids) && is_array($checkbox_ids )) {

            foreach ($checkbox_ids as $checkbox_id) {

                $parts = explode('_', $checkbox_id);
                if(isset($parts[1])) {

                    $product_ids[] = $parts[1];
                }

            }
        }

        foreach (Dish::find()->all() as $dish) {

            /* @var Dish $dish */
           $dish_products_ids = $dish->getProducts()->select('id')->column();

           if ( empty(array_diff($dish_products_ids, $product_ids))) $dishes[]=$dish;

        }
        
        $content = $this->renderAjax('@app/views/site/_dishes', ['dishes' => $dishes]);
        

        return [
            'success' => 1,
            'content' => $content
        ];



    }

}
