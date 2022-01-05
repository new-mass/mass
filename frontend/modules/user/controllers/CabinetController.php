<?php


namespace frontend\modules\user\controllers;

use common\models\SingleViewPost;
use frontend\models\Adress;
use frontend\models\UserMessanger;
use frontend\modules\user\components\helpers\AvatarHelper;
use frontend\modules\user\components\helpers\PublicationHelper;
use frontend\modules\user\components\helpers\SaveNameHelper;
use frontend\modules\user\components\helpers\SaveRelationHelper;
use frontend\modules\user\models\City;
use frontend\modules\user\models\forms\UpdateAvatarForm;
use frontend\modules\user\models\PhoneView;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\PostView;
use frontend\modules\user\models\relation\UserCheckAnket;
use frontend\modules\user\models\relation\UserComfort;
use frontend\modules\user\models\relation\UserMassagDlya;
use frontend\modules\user\models\relation\UserMetro;
use frontend\modules\user\models\relation\UserPlace;
use frontend\modules\user\models\relation\UserPol;
use frontend\modules\user\models\relation\UserRayon;
use frontend\modules\user\models\relation\UserService;
use frontend\modules\user\models\relation\UserWorckTime;
use yii\helpers\ArrayHelper;
use frontend\components\BeforeController as Controller;
use Yii;
use yii\web\UploadedFile;
use frontend\components\Translit;

class CabinetController extends Controller
{

    public function actionIndex($city = 'moskva')
    {
        if (Yii::$app->user->isGuest) return $this->redirect('/');

        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

        $cityInfo = City::getCity($city);

        if (Yii::$app->user->identity->old_id){
            $items = Posts::find()->where(['user_id' => Yii::$app->user->id])
                ->orWhere( ['old_user_id' => Yii::$app->user->identity->old_id])
                ->andWhere(['city_id' => $cityInfo['id']])
                ->andWhere(['hide' => Posts::POSTS_SHOW])
                ->asArray()
                ->with('avatar')
                ->with('viewsOnListing')
                ->with('viewsOnSingle')
                ->with('viewsPhone')
                ->all();
        }else{
            $items = Posts::find()->where(['user_id' => Yii::$app->user->id])
                ->asArray()
                ->with('avatar')
                ->andWhere(['hide' => Posts::POSTS_SHOW])
                ->with('viewsOnListing')
                ->with('viewsOnSingle')
                ->with('viewsPhone')
                ->all();
        }

        return $this->render('index', [
            'items' => $items
        ]);
    }

    public function actionDelete()
    {
        if (Yii::$app->request->isPost and !Yii::$app->user->isGuest){

            $photo = Photo::find()->where(['id' => Yii::$app->request->post('id')])
                ->one();

            if (Yii::$app->user->identity['old_id']){
                $post = Posts::find()
                    ->where(['id' => $photo['user_id'] , 'old_user_id' => Yii::$app->user->identity['old_id']])
                    ->orWhere(['id' => $photo['user_id'] , 'user_id' => Yii::$app->user->id])
                    ->asArray()->one();
            }else{
                $post = Posts::find()->where(['id' => $photo['user_id'] , 'user_id' => Yii::$app->user->id])
                    ->asArray()->one();
            }

            if ($post){

                unlink(Yii::getAlias('@app/web/'.$photo['file']));

                $photo->delete();

            }

        }
    }

    public function actionAdd($city = 'moskva')
    {

        if (Yii::$app->user->isGuest) return $this->redirect('/');

        if (Yii::$app->user->identity['status'] == 9) return $this->redirect('/');

        $model = new \frontend\modules\user\models\Posts();
        $city = City::find()->select('id')->where(['name' => $city])->asArray()->one();
        $userPol = new UserPol();
        $userWorkTime = new UserWorckTime();
        $photo = new Photo();
        $userCheck = new UserCheckAnket();
        $userPlace = new UserPlace();
        $userMassagDlya = new UserMassagDlya();
        $userService = new UserService();
        $userRayon = new UserRayon();
        $userComfort = new UserComfort();
        $userMetro = new UserMetro();
        $userMess = new UserMessanger();

        $adress = new Adress();

        if ($model->load(Yii::$app->request->post()) and $userPol->load(Yii::$app->request->post())
            and $userWorkTime->load(Yii::$app->request->post())
            and $userMassagDlya->load(Yii::$app->request->post())
            and $userComfort->load(Yii::$app->request->post())
            and $userPlace->load(Yii::$app->request->post())
            and $userService->load(Yii::$app->request->post())
            and $userMess->load(Yii::$app->request->post())
            and $userCheck->load(Yii::$app->request->post())) {

            if (UploadedFile::getInstance($model, 'avatar')) {

                if ($model->validate() and $model->save()) {

                    if ($adress->load(Yii::$app->request->post())){

                        $adress->post_id = $model->id;

                        $adress->save();

                    }

                    $model->city_id = $city['id'];

                    $postView = new PostView();
                    $postView->post_id = $model->id;
                    $postView->save();

                    $phoneView = new PhoneView();
                    $phoneView->post_id = $model->id;
                    $phoneView->save();

                    $postView = new SingleViewPost();
                    $postView->post_id = $model->id;
                    $postView->save();


                    $translit = new Translit();

                    $model->url =  SaveNameHelper::save(strtolower($translit->translit($model->name, false, 'ru-en')));

                    $model->save();

                    $userPol->user_id = $model->id;
                    $userWorkTime->post_id = $model->id;

                    if ($userPol->save() and $userWorkTime->save()) {

                        SaveRelationHelper::save(UserCheckAnket::class, $userCheck->prop_id, $model->id);
                        SaveRelationHelper::save(UserPlace::class, $userPlace->prop_id, $model->id);
                        SaveRelationHelper::save(UserService::class, $userService->prop_id, $model->id);
                        SaveRelationHelper::save(UserMessanger::class, $userMess->prop_id, $model->id);

                        SaveRelationHelper::save(UserMassagDlya::class, $userMassagDlya->prop_id, $model->id);

                        if ($userMetro->load(Yii::$app->request->post()))
                            SaveRelationHelper::save(UserMetro::class, $userMetro->prop_id, $model->id);
                        if ($userRayon->load(Yii::$app->request->post()))
                            SaveRelationHelper::save(UserRayon::class, $userRayon->prop_id, $model->id);

                        SaveRelationHelper::save(UserComfort::class, $userComfort->prop_id, $model->id);

                        AvatarHelper::saveAvatar($model, $model->id);

                        AvatarHelper::saveCheckPhoto($model, $model->id);

                        AvatarHelper::saveGallery($model, $model->id);

                        if (AvatarHelper::saveVideo($model, $model->id)){

                            $model->video_sort = 1;

                            $model->save();

                        }

                        Yii::$app->session->setFlash('success', 'Анкета отправлена на модерацию');

                        Yii::$app->mailer->compose()
                            ->setFrom(Yii::$app->params['admin_email'])
                            ->setTo(Yii::$app->params['admin_email'])
                            ->setSubject('новая накета')
                            ->setTextBody('новая накет')
                            ->setHtmlBody('<p>новая Анакета')
                            ->send();

                        return $this->redirect('/cabinet');



                    }

                }
            } else {
                Yii::$app->session->setFlash('error', 'Нужно выбрать аватар');
            }

        }

        $model->age = 18;
        $model->rost = 165;
        $model->work_time = 1;
        $model->price = 1500;
        $model->price_2_hour = 3000;
        $model->breast = 2;
        $model->ves = 50;

        return $this->render('add', [
            'model' => $model,
            'city' => $city,
            'userPol' => $userPol,
            'userWorkTime' => $userWorkTime,
            'photo' => $photo,
            'userCheck' => $userCheck,
            'userPlace' => $userPlace,
            'userMassagDlya' => $userMassagDlya,
            'userService' => $userService,
            'userRayon' => $userRayon,
            'userComfort' => $userComfort,
            'userMetro' => $userMetro,
            'userMess' => $userMess,
        ]);
    }

    public function actionEdit($id, $city = 'moskva')
    {
        if (Yii::$app->user->isGuest) return $this->redirect('/');
        $model = Posts::find()->where(['id' => $id])->with('allComments')->one();
        $city = City::find()->select('id')->where(['name' => $city])->asArray()->one();

        $userCheck = new UserCheckAnket();
        $userPlace = new UserPlace();
        $userMassagDlya = new UserMassagDlya();
        $userService = new UserService();
        $userRayon = new UserRayon();
        $userComfort = new UserComfort();
        $userPol = new UserPol();
        $userWorkTime = new UserWorckTime();
        $userMetro = new UserMetro();
        $userMess = new UserMessanger();

        $adress = \frontend\models\Adress::findOne(['post_id' => $model->id]) ?? new \frontend\models\Adress();

        if ($model->load(Yii::$app->request->post()) and $userPol->load(Yii::$app->request->post())
            and $userWorkTime->load(Yii::$app->request->post())
            and $userMassagDlya->load(Yii::$app->request->post())
            and $userComfort->load(Yii::$app->request->post())
            and $userPlace->load(Yii::$app->request->post())
            and $userService->load(Yii::$app->request->post())
            and $userPol->load(Yii::$app->request->post())
            and $userMess->load(Yii::$app->request->post())
            and $userCheck->load(Yii::$app->request->post())) {

            if ($model->validate() and $model->save()) {

                if ($adress->load(Yii::$app->request->post())){

                    $adress->post_id = $model->id;

                    $adress->save();

                }

                $userPol->user_id = $model->id;
                $userPol->save();
                $userWorkTime->post_id = $model->id;

                if ($userWorkTime->save()) {

                    SaveRelationHelper::save(UserCheckAnket::class, $userCheck->prop_id, $model->id);
                    SaveRelationHelper::save(UserPlace::class, $userPlace->prop_id, $model->id);
                    SaveRelationHelper::save(UserService::class, $userService->prop_id, $model->id);
                    SaveRelationHelper::save(UserMassagDlya::class, $userMassagDlya->prop_id, $model->id);
                    SaveRelationHelper::save(UserMessanger::class, $userMess->prop_id, $model->id);
                    if ($userRayon->load(Yii::$app->request->post()))
                        SaveRelationHelper::save(UserRayon::class, $userRayon->prop_id, $model->id);
                    if ($userMetro->load(Yii::$app->request->post()))
                        SaveRelationHelper::save(UserMetro::class, $userMetro->prop_id, $model->id);

                    SaveRelationHelper::save(UserComfort::class, $userComfort->prop_id, $model->id);


                    AvatarHelper::saveAvatar($model, $model->id);

                    AvatarHelper::saveCheckPhoto($model, $model->id);

                    if (AvatarHelper::saveVideo($model, $model->id)){

                        $model->video_sort = 1;

                        $model->save();

                    }

                    AvatarHelper::saveGallery($model, $model->id);

                    Yii::$app->session->setFlash('success', 'Анкета отредактирована');
                    return $this->redirect('/cabinet');

                }

            }


        }

        $userPol = UserPol::find()->where(['user_id' => $model->id])->one() ?: new UserPol() ;
        $userWorkTime = UserWorckTime::find()->where(['post_id' => $model->id])->one() ?: new UserWorckTime();
        $photo = Photo::find()->where(['user_id' => $model->id])->one();
        $userCheck->prop_id = ArrayHelper::getColumn(UserCheckAnket::find()->where(['user_id' => $model->id])->all(), 'prop_id');

        $userPlace->prop_id = ArrayHelper::getColumn(UserPlace::find()->where(['user_id' => $model->id])->all(), 'prop_id');
        $userMassagDlya->prop_id = ArrayHelper::getColumn(UserMassagDlya::find()->where(['user_id' => $model->id])->all(), 'prop_id');
        $userService->prop_id = ArrayHelper::getColumn(UserService::find()->where(['user_id' => $model->id])->all(), 'prop_id');
        $userRayon->prop_id = ArrayHelper::getColumn(UserRayon::find()->where(['user_id' => $model->id])->all(), 'prop_id');
        $userComfort->prop_id = ArrayHelper::getColumn(UserComfort::find()->where(['user_id' => $model->id])->all(), 'prop_id');
        $userMetro->prop_id = ArrayHelper::getColumn(UserMetro::find()->where(['user_id' => $model->id])->all(), 'prop_id');
        $userMess->prop_id = ArrayHelper::getColumn(UserMessanger::find()->where(['user_id' => $model->id])->all(), 'prop_id');

        return $this->render('edit', [
            'model' => $model,
            'userPol' => $userPol,
            'userWorkTime' => $userWorkTime,
            'photo' => $photo,
            'userCheck' => $userCheck,
            'userPlace' => $userPlace,
            'userMassagDlya' => $userMassagDlya,
            'userService' => $userService,
            'userRayon' => $userRayon,
            'userComfort' => $userComfort,
            'city' => $city,
            'userMetro' => $userMetro,
            'userMess' => $userMess,
        ]);
    }

    public function actionFaq()
    {
        if (Yii::$app->user->isGuest) return $this->redirect('/');
        return $this->render('faq');
    }

    public function actionUp()
    {
        if (!Yii::$app->request->isPost or Yii::$app->user->isGuest) return $this->goHome();

        try {

            $publicationHelper = new PublicationHelper(Yii::$app->request->post('id'));

            return $publicationHelper->upAnket()->getStatusUpAnket();

        }catch (\Exception $exception){

            return $exception->getMessage();

        }
    }

    public function actionUpdateAvatar()
    {
        $model = new UpdateAvatarForm();

        if ($model->load(Yii::$app->request->post())){

            $result = $model->updateAvatar();

            return $result['file'];

        }

    }


}