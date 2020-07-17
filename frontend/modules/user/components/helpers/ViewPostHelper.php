<?php


namespace frontend\modules\user\components\helpers;
use Yii;

class ViewPostHelper
{
    public static function addToView($id)
    {

        $UserCookies = Yii::$app->request->cookies;

        $cookies = Yii::$app->response->cookies;

        if ($data = $UserCookies->getValue('prosmotri') !== null){

            $data = unserialize($UserCookies['prosmotri']->value);

            if (!in_array($id, $data)){

                $data[] = $id;

                // добавление новой куки в HTTP-ответ
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'prosmotri',
                    'value' => serialize($data),
                ]));

            }

        }else{

            $data = array();

            $data[] = $id;

            // добавление новой куки в HTTP-ответ
            $cookies->add(new \yii\web\Cookie([
                'name' => 'prosmotri',
                'value' => serialize($data),
            ]));
        }

    }

    public static function getCount()
    {

        $UserCookies = Yii::$app->request->cookies;

        if ($data = $UserCookies->getValue('prosmotri') !== null){

            $data = unserialize($UserCookies['prosmotri']->value);

            return count($data);

        }

        return 0;
    }

    public static function getView()
    {
        $UserCookies = Yii::$app->request->cookies;

        if ($data = $UserCookies->getValue('prosmotri') !== null){

            return unserialize($UserCookies['prosmotri']->value);

        }

        return null;
    }
}