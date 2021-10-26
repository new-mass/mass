<?php

namespace frontend\components\helpers;
use Yii;

class PostOrderHelper
{
    public static function getOrderAndSetOrderCookie()
    {
        $order = 'tarif_id desc, check_photo_status desc, video_sort desc, sorting desc';

        $cookiesRequest = Yii::$app->request->cookies;

        if (
            $userOrder = Yii::$app->request->get('price') or
            $userOrder = $cookiesRequest->getValue('sort_price')
        ){

            $cookies = Yii::$app->response->cookies;

            switch ($userOrder) {
                case 'up':
                    $order = ['price' => SORT_ASC];
                    break;
                case 'down':
                    $order = ['price' => SORT_DESC];
                    break;
                case 'default':
                    $cookies->add(new \yii\web\Cookie([
                        'name' => 'sort_price',
                        'value' => $userOrder,
                        'expire' => -1,
                    ]));
                    return $order;
                    break;

            }


            $cookies->add(new \yii\web\Cookie([
                'name' => 'sort_price',
                'value' => $userOrder,
                'expire' => time() + 3600,
            ]));

            return $order;

        }

        return $order;

    }
}