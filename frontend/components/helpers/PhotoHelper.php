<?php


namespace frontend\components\helpers;
use frontend\modules\user\models\Photo;
use Yii;
use yii\helpers\ArrayHelper;

class PhotoHelper
{
    public static function getPhotoCount($post_id)
    {

        $count = Yii::$app->cache->get(Yii::$app->params['post_photo_count_key'].'_'.$post_id);

        if ($count === false) {

            $count = Photo::find()->where(['user_id' => $post_id, 'avatar' => 0])->count('file');

            Yii::$app->cache->set(Yii::$app->params['post_photo_count_key'].'_'.$post_id, $count);

        }
        return $count;
    }

    public static function getAvatar($post_id)
    {

        return ArrayHelper::getValue( Photo::find()->where(['user_id' => $post_id, 'avatar' => 1])->select('file')->asArray()->one(), 'file');
    }

    public static function getPhoto($post_id, $offset = 0)
    {
        return ArrayHelper::getValue( Photo::find()->where(['user_id' => $post_id, 'avatar' => 0])
            ->limit(1)->offset($offset)->select('file')->asArray()->one(), 'file');

    }


}