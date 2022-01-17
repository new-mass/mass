<?php

namespace common\components;

use Yii;

class PayLinkBuilder
{
    public static function buildPayLink($city, $userId, $paySum) : string
    {
        $order_id = $userId.'_'.$city;

        $merchant_id = Yii::$app->params['freekassa_id'];
        $secret_word = Yii::$app->params['freekassa_sercret_word'];
        $order_amount = $paySum;
        $currency = 'RUB';
        $sign = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$currency.':'.$order_id);

        $params = '?m='.Yii::$app->params['freekassa_id'].
            '&oa='.$paySum.
            '&o='.$order_id.
            '&currency=RUB'.
            '&s='.$sign;

        return Yii::$app->params['new_cassa_url'].$params;
    }
}