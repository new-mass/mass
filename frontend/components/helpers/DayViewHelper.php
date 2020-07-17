<?php


namespace frontend\components\helpers;
use yii;

class DayViewHelper
{
    public static function addViewListing($posts)
    {
        if (is_array($posts) and !empty($posts)){

            foreach ($posts as $post){

                DayViewHelper::updateCount(Yii::$app->params['view_today_cache_key'].'_'.date('d').'_'.$post['id']);

            }

        }
    }

    public static function addViewSingle($id)
    {

        DayViewHelper::updateCount(Yii::$app->params['single_view_today_cache_key'].'_'.date('d').'_'.$id);

    }



    public static function updateCount($key)
    {
        $data = Yii::$app->cache->get($key);

        if ($data === false) {

            $data = Yii::$app->cache->set($key, 1, 3600 * 24 );

        }else{

            $data = Yii::$app->cache->set($key, $data + 1, 3600 * 24 );

        }
    }
}