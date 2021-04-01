<?php


namespace frontend\modules\user\components\helpers;

use frontend\modules\user\models\Photo;
use yii\web\UploadedFile;
use Yii;

class AvatarHelper
{
    public static function saveAvatar($model, $userId)
    {
        $file = UploadedFile::getInstance($model, 'avatar');

        if ($file) {

            return AvatarHelper::savePhoto($file, $userId, 1);

        }
    }
    public static function saveVideo($model, $userId) :bool
    {

        if ($video = Photo::find()->where(['user_id' =>$userId , 'type' => Photo::TYPE_VIDEO])->limit(1)->one()){

            unlink(Yii::getAlias('@frontend/web'.$video->file));

            $video->delete();

        }

        $file = UploadedFile::getInstance($model, 'video');

        if ($file) {

            return AvatarHelper::saveVideoFile($file, $userId);

        }
    }

    public static function saveGallery($model, $userId)
    {
        $file = UploadedFile::getInstances($model, 'gallery');

        if ($file) {

            foreach ($file as $item) {

                AvatarHelper::savePhoto($item, $userId);

            }

        }

    }

    public static function savePhoto($file, $userId, $avatar = 0)
    {

        if ($avatar) Photo::updateAll(['avatar' => 0], ['user_id' => $userId]);

        $photo = new Photo();

        $photo->file = 'photo-' . $userId . '-' . \md5($file->name) . \time() . '.jpg';

        $dir_hash = DirHelprer::generateDirNameHash($photo->file) . '/';

        $dir = Yii::$app->params['photo_path'] . $dir_hash;

        $save_dir = DirHelprer::prepareDir(Yii::getAlias('@webroot') . $dir);

        ImageHelper::prepareImage($file, $save_dir, $photo->file);

        $photo->user_id = $userId;

        $photo->avatar = $avatar;

        $photo->file = $dir . $photo->file;

        return $photo->save();

    }

    public static function saveVideoFile(UploadedFile $file, $userId)
    {

        if ($file){

            $photo = new Photo();

            $photo->file = 'video-' . $userId . '-' . \md5($file->name) . \time() . '.'.$file->getExtension();

            $dir_hash = DirHelprer::generateDirNameHash($photo->file) . '/';

            $dir = Yii::$app->params['photo_path'] . $dir_hash;

            $save_dir = DirHelprer::prepareDir(Yii::getAlias('@webroot') . $dir);

            $file->saveAs($save_dir.$photo->file);

            $photo->user_id = $userId;

            $photo->avatar = 0;

            $photo->type = Photo::TYPE_VIDEO;

            $photo->file = $dir . $photo->file;

            return $photo->save();

        }

        return false;

    }
}