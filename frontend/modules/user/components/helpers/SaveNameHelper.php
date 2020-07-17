<?php


namespace frontend\modules\user\components\helpers;

use frontend\modules\user\models\Posts;

class SaveNameHelper
{
    public static function save($PostUrl)
    {

        $i = 0;

        if (SaveNameHelper::FindName($PostUrl)){

            $i++;

            a:

            $i++;

            $name = $PostUrl . '-' .$i;

            if (SaveNameHelper::FindName($name)) goto a;

            return $name;

        }

        return  $PostUrl;

    }

    public static function FindName($name)
    {

        if (Posts::find()->where(['url' => $name])->asArray()->one()) return true;

    }
}