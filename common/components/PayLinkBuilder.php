<?php

namespace common\components;

use Yii;

class PayLinkBuilder
{
    public static function buildPayLink($city, $userId, $paySum) : string
    {
        $order_id = $userId.'_'.$city;

        $sign = \md5(Yii::$app->params['merchant_id'].':'.$paySum.':'.Yii::$app->params['fk_merchant_key'].':'.$order_id);

        $params = 'm='.Yii::$app->params['merchant_id'].
            '&oa='.$paySum.
            '&o='.$order_id.
            '&s='.$sign;

        return Yii::$app->params['cassa_url'].$params;
    }
}