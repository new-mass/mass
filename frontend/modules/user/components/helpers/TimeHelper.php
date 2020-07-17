<?php


namespace frontend\modules\user\components\helpers;


class TimeHelper
{
    public static function generateDayTime()
    {
        $time = range(0, 24);

        $result = array();

        foreach ($time as $item){

            $result[] = ['key' => $item, 'value'=> $item.':00'];

        }

        return $result;
    }
}