<?php


namespace frontend\modules\user\controllers;

use common\components\HystoryHelper;
use common\models\SingleViewPost;
use common\models\User;
use frontend\components\helpers\DayViewHelper;
use frontend\modules\user\components\helpers\PublicationHelper;
use frontend\modules\user\models\City;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\Tarif;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\modules\user\components\helpers\ViewPostHelper;
use Yii;

class PostController extends Controller
{

    public function actionView($url, $city = 'moskva')
    {

        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

        if ($post = Posts::find()->where(['url' => $url])
            ->with('avatar')
            ->with('gallery')
            ->with('service')
            ->with('massagDlya')
            ->with('place')
            ->with('check')
            ->with('workTime')
            ->with('rayon')
            ->with('comments')
            ->asArray()->one()){

            SingleViewPost::updateAllCounters(['count' => 1], ['post_id' =>$post['id'] ]);

            DayViewHelper::addViewSingle($post['id']);

            ViewPostHelper::addToView($post['id']);

            $city = City::find()->where(['name' => $city])->asArray()->one();

            return $this->render('view', [
                'post' => $post,
                'city' => $city,
            ]);

        }

         throw new NotFoundHttpException();

    }

    public function actionPublication()
    {
        if (!\Yii::$app->user->isGuest and \Yii::$app->request->isPost){

            try {

                $publicationHelper = new PublicationHelper(Yii::$app->request->post('id'));

                return $publicationHelper->startPublication()->getStatusPostPublication();

            }catch (\Exception $exception){

                return $exception->getMessage();

            }

        }

        //return $this->goHome();
    }

    public function actionMorePost($city)
    {
        if (\Yii::$app->request->isPost){

            $temp = explode(',', htmlspecialchars(rtrim(\Yii::$app->request->post('post_id'), ',')));

            if ($post = Posts::find()->where(['not in' , 'id', $temp])
                ->with('avatar')
                ->with('gallery')
                ->with('service')
                ->with('massagDlya')
                ->with('place')
                ->with('check')
                ->with('workTime')
                ->with('rayon')
                ->with('comments')
                ->orderBy(['rand()' => SORT_DESC])
                ->asArray()->one()){

                return $this->renderFile(Yii::getAlias('@app/modules/user/views/post/post.php'), [
                    'post' => $post,
                ]);

            }

        }
    }

    public function actionRedirect($city, $url)
    {
        if ($post = Posts::find()->where(['old_url' => $url])->asArray()->one()){

            return $this->redirect('/anketa/'.$post['url'], 301);

        }

        throw new NotFoundHttpException();

    }

}