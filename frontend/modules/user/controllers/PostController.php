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
use frontend\components\BeforeController as Controller;
use yii\caching\DbDependency;
use yii\web\NotFoundHttpException;
use frontend\modules\user\components\helpers\ViewPostHelper;
use Yii;

class PostController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionView($url, $city = 'moskva')
    {

        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

        $city = City::getCity($city);

        if ($post = Posts::getPostByUrl($url, $city['id'])){

            SingleViewPost::updateAllCounters(['count' => 1], ['post_id' =>$post['id'] ]);

            DayViewHelper::addViewSingle($post['id']);

            ViewPostHelper::addToView($post['id']);

            return $this->render('view', [
                'post' => $post,
                'city' => $city,
            ]);

        }

        throw new NotFoundHttpException('Страница не найдена');

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

    public function actionMorePost($city = 'moskva')
    {
        if (\Yii::$app->request->isPost){

            $temp = explode(',', htmlspecialchars(rtrim(\Yii::$app->request->post('post_id'), ',')));

            $city = City::getCity($city);

            if ($post = Posts::find()->where(['not in' , 'id', $temp])
                ->andWhere(['status' => Posts::POST_ON_PUBLICATION])
                ->andWhere(['city_id' => $city['id']])
                ->with('avatar')
                ->with('gallery')
                ->with('service')
                ->with('massagDlya')
                ->with('place')
                ->with('check')
                ->with('workTime')
                ->with('rayon')
                ->with('comfort')
                ->with('comments')
                ->with('adress')
                ->orderBy(['rand()' => SORT_DESC])
                ->asArray()->limit(1)->one()){

                SingleViewPost::updateAllCounters(['count' => 1], ['post_id' =>$post['id'] ]);

                DayViewHelper::addViewSingle($post['id']);

                ViewPostHelper::addToView($post['id']);

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