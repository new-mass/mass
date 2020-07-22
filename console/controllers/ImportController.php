<?php


namespace console\controllers;

use common\models\User;
use frontend\components\Translit;
use frontend\modules\user\components\helpers\SaveNameHelper;
use frontend\modules\user\models\MassagDlya;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\relation\UserCheckAnket;
use frontend\modules\user\models\relation\UserMassagDlya;
use yii\console\Controller;

class ImportController extends Controller
{
    public function actionUser()
    {
        $users = include \Yii::getAlias('@app/controllers/files/rostov_users.php');

       foreach ($users as $userItem){

           $user = new User();
           $user->username = $userItem['name'];
           $user->email = $userItem['email'];
           $user->old_id = $userItem['id'];

           $user->setPassword($userItem['pass']);
           $user->generateAuthKey();
           $user->generateEmailVerificationToken();

           if ($userItem['status'] == 1) $user->status = 10;
           else $user->status = 9;

           $user->old_pass = $userItem['pass'];
           $user->city_id = 7;

           $user->save();

       }
    }

    public function actionPosts()
    {

        $translit = new Translit();

        $posts = include \Yii::getAlias('@app/controllers/files/rostov-na-donu_posts.php');

        foreach ($posts as $post){

            $model = new \frontend\modules\user\models\Posts();

            $model->old_id = $post['id'];
            $model->city_id = 7;
            $model->tarif_id = $post['tarif'];
            $model->sorting = 1;
            $model->name = $post['name'];
            $model->phone = $post['phone'];
            $model->age = $post['age'];
            $model->rost = $post['rost'];
            $model->price = $post['price'];
            $model->price_2_hour = $post['price_2_hour'];
            $model->about = $post['about'];
            $model->breast = $post['grud'];
            $model->ves = $post['weight'];
            $model->work_time = $post['work_time'];
            $model->old_url = $post['url'];

            if ($post['online'] == 7) $model->status = Posts::POST_ON_PUBLICATION;
            else $model->status = Posts::POST_DONT_PUBLICATION;

            $model->url = $model->url = SaveNameHelper::save(strtolower($translit->translit($model->name, false, 'ru-en')));

            $model->old_user_id = $post['user_id'];

            $model->saveOriginalMethod();

            if ($post['check_by_photo'] == 1){

                $userCheckAnket = new UserCheckAnket();
                $userCheckAnket->user_id = $model->id;
                $userCheckAnket->prop_id = 2;
                $userCheckAnket->save();

            }

            if ($post['check_by_video'] == 1){

                $userCheckAnket = new UserCheckAnket();
                $userCheckAnket->user_id = $model->id;
                $userCheckAnket->prop_id = 1;
                $userCheckAnket->save();

            }

            $massagDlyaList = explode(' ', $post['massazh-dlya']);

            foreach ($massagDlyaList as $massagDlyaItem){

                if ($massagDlyaItem == 'женщин') {
                    $massagDlyaClass = new UserMassagDlya();
                    $massagDlyaClass->user_id = $model->id;
                    $massagDlyaClass->prop_id = 2;
                    $massagDlyaClass->save();
                }
                if ($massagDlyaItem == 'мужчин') {
                    $massagDlyaClass = new UserMassagDlya();
                    $massagDlyaClass->user_id = $model->id;
                    $massagDlyaClass->prop_id = 1;
                    $massagDlyaClass->save();
                }
                if ($massagDlyaItem == 'пар') {
                    $massagDlyaClass = new UserMassagDlya();
                    $massagDlyaClass->user_id = $model->id;
                    $massagDlyaClass->prop_id = 3;
                    $massagDlyaClass->save();
                }

            }

            $avatar = new Photo();
            $avatar->user_id = $model->id;
            $avatar->file = $post['single_avatar'];
            $avatar->avatar = 1;
            $avatar->save();

            preg_match_all("~<a\s.*?href=\"(.+?)\".*?>(.+?)</a>~", $post['galary'], $out);

            $galleryListHtml = $out;

            if($galleryListHtml)foreach ($galleryListHtml[1] as $galItem){

                $avatar = new Photo();
                $avatar->user_id = $model->id;
                $avatar->file = $galItem;
                $avatar->avatar = 0;
                $avatar->save();

            }

        }

    }

}