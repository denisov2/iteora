<?php

namespace app\controllers;

use app\models\Dish;
use app\models\Queue;
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

    /**
     * @return array
     * @throws ForbiddenHttpException
     */
    public function actionOrderDish()
    {
        if (!\Yii::$app->request->isAjax || !\Yii::$app->request->isPost) throw new ForbiddenHttpException();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $dish_id = \Yii::$app->request->post('dish_id');
        if (Queue::add($dish_id)) $success = 1;
        else $success = 0;
        $content = $this->renderAjax('@app/views/site/_queue');
        return [
            'success' =>$success,
            'content' => $content
        ];
    }

    /**
     * @return array
     * @throws ForbiddenHttpException
     */

    public function actionOrderClear()
    {
        if (!\Yii::$app->request->isAjax || !\Yii::$app->request->isPost) throw new ForbiddenHttpException();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        Queue::deleteAll(['session_id' => \Yii::$app->session->id]);
        $content = $this->renderAjax('@app/views/site/_queue');

        return ['content' => $content];
    }

    /**
     * @return array
     * @throws ForbiddenHttpException
     */
    public function actionCheckQueue()
    {
        if (!\Yii::$app->request->isAjax || !\Yii::$app->request->isPost) throw new ForbiddenHttpException();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $deleted = Queue::check(['session_id' => \Yii::$app->session->id]);
        $content = $this->renderAjax('@app/views/site/_queue');

        return [
            'content' => $content,
            'deleted' => $deleted,
        ];
    }


}
