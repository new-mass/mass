<?php


namespace frontend\modules\user\components\helpers;

use common\models\CheckPhotoRequest;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Posts;
use yii\web\UploadedFile;
use Yii;

class AvatarHelper
{
    public static function saveAvatar($model, $userId, $attributeName = 'avatar')
    {
        $file = UploadedFile::getInstance($model, $attributeName);

        if ($file) {

            self::dropCheckPhotoStatus($model);

            return AvatarHelper::savePhoto($file, $userId, 1);

        }
    }
    public static function saveVideo($model, $userId)
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

    public static function saveCheckPhoto($model, $userId)
    {

        $file = UploadedFile::getInstance($model, 'checkPhoto');

        if ($file) {

            if ($photo = Photo::find()->where(['user_id' => $userId , 'type' => Photo::CHECK_PHOTO])->limit(1)->one()){

                unlink(Yii::getAlias('@frontend/web'.$photo->file));

                $photo->delete();

                self::dropCheckPhotoStatus($model);

            }

            $checkPhotoRequest = new CheckPhotoRequest();

            $checkPhotoRequest->post_id = $userId;

            $checkPhotoRequest->save();

            return AvatarHelper::savePhoto($file, $userId, 0, Photo::CHECK_PHOTO);

        }
    }

    public static function dropCheckPhotoStatus(Posts $model)
    {
        $model->check_photo_status = Posts::PHOTO_NOT_CHECK;

        $model->save();
    }

    public static function saveGallery($model, $userId)
    {
        $file = UploadedFile::getInstances($model, 'gallery');

        if ($file) {

            foreach ($file as $item) {

                AvatarHelper::savePhoto($item, $userId);

            }

            self::dropCheckPhotoStatus($model);

        }

    }

    public static function savePhoto($file, $userId, $avatar = 0, $type = 0)
    {

        if ($avatar) {

            if ($oldFile = Photo::findOne(['user_id' => $userId, 'avatar' => 1 ])){

                unlink(Yii::getAlias('@frontend/web'.$oldFile->file));

                $oldFile->delete();

            }

            Photo::updateAll(['avatar' => 0], ['user_id' => $userId]);

        }

        $photo = new Photo();

        $photo->file = 'photo-' . $userId . '-' . \md5($file->name) . \time() . '.jpg';

        $dir_hash = DirHelprer::generateDirNameHash($photo->file) . '/';

        $dir = Yii::$app->params['photo_path'] . $dir_hash;

        $save_dir = DirHelprer::prepareDir(Yii::getAlias('@webroot') . $dir);

        ImageHelper::prepareImage($file, $save_dir, $photo->file);

        $photo->user_id = $userId;

        $photo->avatar = $avatar;

        $photo->type = $type;

        $photo->file = $dir . $photo->file;

        if ($photo->save()) return $photo;

        return false;

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