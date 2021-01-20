<?php


namespace console\controllers;

use common\models\SingleViewPost;
use common\models\User;
use frontend\components\Translit;
use frontend\modules\user\components\helpers\SaveNameHelper;
use frontend\modules\user\models\City;
use frontend\modules\user\models\Comfort;
use frontend\modules\user\models\Comments;
use frontend\modules\user\models\MassagDlya;
use frontend\modules\user\models\PhoneView;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Place;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\PostView;
use frontend\modules\user\models\Rayon;
use frontend\modules\user\models\relation\UserCheckAnket;
use frontend\modules\user\models\relation\UserComfort;
use frontend\modules\user\models\relation\UserMassagDlya;
use frontend\modules\user\models\relation\UserPlace;
use frontend\modules\user\models\relation\UserRayon;
use frontend\modules\user\models\relation\UserService;
use frontend\modules\user\models\relation\UserWorckTime;
use frontend\modules\user\models\Service;
use yii\base\Model;
use yii\console\Controller;

class ImportController extends Controller
{

    public $tablePref = 'rostov-na-donu';
    public $city_id = 7;

    public function actionUser()
    {
        $users = \Yii::$app->db2->createCommand("SELECT * FROM `{$this->tablePref}_users`")->queryAll();

       foreach ($users as $userItem){

           $user = new User();
           $user->username = $userItem['name'];
           $user->email = $userItem['email'];
           $user->old_id = $userItem['id'];

           $cash = \Yii::$app->db2->createCommand("SELECT * from `obt_cash` WHERE `city` = '".$this->tablePref."' AND  `id_user` = ".$userItem['id'] )->queryOne();

           if (isset($cash['cash'])) $user->cash = $cash['cash'];

           $user->setPassword($userItem['pass']);
           $user->generateAuthKey();
           $user->generateEmailVerificationToken();

           if ($userItem['status'] == 1) $user->status = 10;
           else $user->status = 9;

           $user->old_pass = $userItem['pass'];
           $user->city_id = $this->city_id;

           $user->save();



       }
    }

    public function actionPosts()
    {

        $city = City::findOne($this->city_id);

        $translit = new Translit();

        $posts = \Yii::$app->db2->createCommand("SELECT * FROM `{$this->tablePref}_posts`")->queryAll();

        foreach ($posts as $post){

            $model = new \frontend\modules\user\models\Posts();

            $model->old_id = $post['id'];
            $model->city_id = $city['id'];
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

            $model->url = $model->url = SaveNameHelper::save(strtolower($translit->translit(trim($model->name), false, 'ru-en')));

            $model->old_user_id = $post['user_id'];

            $model->saveOriginalMethod();

            $postView = new PostView();
            $postView->post_id = $model->id;
            $postView->save();

            $phoneView = new PhoneView();
            $phoneView->post_id = $model->id;
            $phoneView->save();

            $postView = new SingleViewPost();
            $postView->post_id = $model->id;
            $postView->save();

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
            $avatar->file = str_replace('/upload/images/products/', '/uploads/aaa/',$post['single_avatar']);
            $avatar->avatar = 1;
            $avatar->save();

            preg_match_all("~<a\s.*?href=\"(.+?)\".*?>(.+?)</a>~", $post['galary'], $out);

            $galleryListHtml = $out;

            if($galleryListHtml)foreach ($galleryListHtml[1] as $galItem){

                $avatar = new Photo();
                $avatar->user_id = $model->id;
                $avatar->file = str_replace('/upload/images/products/', '/uploads/aaa/',$galItem);
                $avatar->avatar = 0;
                $avatar->save();

            }

            $userService = \Yii::$app->db2->createCommand("SELECT * FROM `{$this->tablePref}_user_service` WHERE `post_id` = {$post['id']}")->queryAll();

            if ($userService) foreach ($userService as $item){

                $service = \Yii::$app->db2->createCommand("SELECT * FROM `service` WHERE `id` = {$item['service_id']}")->queryOne();

                if (isset($service['url'])){
                    $newService = Service::find()->where(['url' => $service['url']])->asArray()->one();

                    $serviceModel = new UserService();
                    $serviceModel->user_id = $model->id;
                    $serviceModel->prop_id = $newService['id'];

                    $serviceModel->save();
                }




            }

            $userRayon = \Yii::$app->db2->createCommand("SELECT * FROM `{$this->tablePref}_user_rayon` WHERE `post_id` = {$post['id']}")->queryAll();

            if ($userRayon) foreach ($userRayon as $item){

                $service = \Yii::$app->db2->createCommand("SELECT * FROM `{$this->tablePref}_rayon` WHERE `id` = {$item['rayon_id']}")->queryOne();
                if (isset($service['url'])){
                $newService = Rayon::find()->where(['url' => $service['url']])->asArray()->one();

                $serviceModel = new UserRayon();
                $serviceModel->user_id = $model->id;
                $serviceModel->prop_id = $newService['id'];

                $serviceModel->save();


            }
            }

            $userPlace = \Yii::$app->db2->createCommand("SELECT * FROM `{$this->tablePref}_posts_to_place` WHERE `post_id` = {$post['id']}")->queryAll();

            if ($userPlace) foreach ($userPlace as $item){

                $service = \Yii::$app->db2->createCommand("select * from `place`  WHERE `id` = {$item['place_id']}")->queryOne();
                if (isset($service['url'])){
                $newService = Place::find()->where(['url' => $service['url']])->asArray()->one();

                $serviceModel = new UserPlace();
                $serviceModel->user_id = $model->id;
                $serviceModel->prop_id = $newService['id'];

                $serviceModel->save();


            }
            }

            $worckTime = \Yii::$app->db2->createCommand("SELECT * FROM `work_hour_time` WHERE `post_id` = {$post['id']} and `city` = '".$city['name']."'")->queryOne();

            if ($worckTime) {

                $userWorckTime = new UserWorckTime();
                $userWorckTime->from = $worckTime['time_from'];
                $userWorckTime->to = $worckTime['time_to'];
                $userWorckTime->post_id = $model->id;

                $userWorckTime->save();


            }

            $userComfort = \Yii::$app->db2->createCommand("SELECT * FROM `user_comfort` WHERE `post_id` = {$post['id']} and `city_id` = '9'")->queryAll();

            if ($userComfort) foreach ($userComfort as $userComfortItem){

                $service = \Yii::$app->db2->createCommand("select * from `comfort`  WHERE `id` = {$userComfortItem['comfort_id']}")->queryOne();
                if (isset($service['value'])){
                $newService = Comfort::find()->where(['value' => $service['value']])->asArray()->one();

                $postComfort = new UserComfort();
                $postComfort->prop_id = $newService['id'];
                $postComfort->user_id = $model->id;

                $postComfort->save();


            }
            }

            $comments = \Yii::$app->db2->createCommand("SELECT * FROM `{$this->tablePref}_comments` WHERE `id_post` = {$post['id']} ")->queryAll();

            if ($comments) foreach ($comments as $comment){

                if ($comment['parent_id'] > 0){

                    $parentComment = Comments::find()->where(['old_id' => $comment['parent_id'], 'city_id' => $city['id']])->asArray()->one();

                    $postComment = new Comments();

                    $postComment->post_id = $model->id;
                    $postComment->name = $comment['author'];
                    $postComment->old_id = $comment['id'];
                    $postComment->city_id = $city['id'];
                    $postComment->mark = $comment['marc'];
                    $postComment->status = 1;
                    $postComment->text = $comment['text'];
                    $postComment->old_date = $comment['date'];
                    $postComment->parent_id = $parentComment['id'];
                    $postComment->save();

                }else{

                    $postComment = new Comments();

                    $postComment->post_id = $model->id;
                    $postComment->name = $comment['author'];
                    $postComment->old_id = $comment['id'];
                    $postComment->city_id = $city['id'];
                    $postComment->mark = $comment['marc'];
                    $postComment->status = 1;
                    $postComment->old_date = $comment['date'];
                    $postComment->text = $comment['text'];
                    $postComment->save();

                }


            }


        }

    }

    public function actionCust()
    {
        $posts = Posts::find()->asArray()->all();

        foreach ($posts as $post){

            $userComfort = \Yii::$app->db2->createCommand("SELECT * FROM `user_comfort` WHERE `post_id` = {$post['old_id']} and `city_id` = '9'")->queryAll();

            if ($userComfort) foreach ($userComfort as $userComfortItem){

                $service = \Yii::$app->db2->createCommand("select * from `comfort`  WHERE `id` = {$userComfortItem['comfort_id']}")->queryOne();
                if (isset($service['value'])){
                    $newService = Comfort::find()->where(['value' => $service['value']])->asArray()->one();

                    $postComfort = new UserComfort();
                    $postComfort->prop_id = $newService['id'];
                    $postComfort->user_id = $post['id'];

                    $postComfort->save();


                }
            }

        }

    }

}