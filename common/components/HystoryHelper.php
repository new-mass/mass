<?php


namespace common\components;


use frontend\modules\user\models\Hystory;

class HystoryHelper
{
    public static function add($user_id, $sum, $balance, $type)
    {
        $hystory = new Hystory();

        $hystory->user_id = $user_id;
        $hystory->sum = $sum;
        $hystory->balance = $balance;
        $hystory->timestamp = time();
        $hystory->type = $type;

        $hystory->save();
    }
}