<?php


namespace frontend\components\helpers;
use Yii;

class PhoneViewHelper
{
    public static function addView($id)
    {

        DayViewHelper::updateCount(Yii::$app->params['phone_view_today_cache_key'].'_'.date('d').'_'.$id);

    }
}