<?php


namespace frontend\modules\user\controllers;

use common\components\HystoryHelper;
use common\models\SingleViewPost;
use common\models\User;
use frontend\components\helpers\DayViewHelper;
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

            if ($post = Posts::find()->where(['id' => \Yii::$app->request->post('id')])->one()) {

                if ($post->status == Posts::POST_ON_PUBLICATION){

                    $post->status = Posts::POST_DONT_PUBLICATION;

                    $post->save();

                    return 'Поставить на публикацию';

                }

                if ($post->status == Posts::POST_DONT_PUBLICATION){

                    if ($post->tarif_id > 0){

                        if ($post->pay_time < time() ){

                            $tarif = Tarif::find()->where(['value' => $post['tarif_id']])->asArray()->one();

                            $user = User::find()->where(['id' => $post['user_id']])->one();

                            if ($user->cash >=  $tarif['value']){

                                $user->cash = $user->cash - $tarif['value'];

                                if ($user->save()){

                                    $post['pay_time'] = time() + 3600;

                                    $post->status = Posts::POST_ON_PUBLICATION;

                                    $post->save();

                                    HystoryHelper::add($user->id, $tarif['value'], $user->cash, 'Публикация анкеты '.$post['name'].' id '.$post['id']);

                                    return 'Снять с публикации';

                                }

                            }else{

                                return 'Недостаточно средств';

                            }

                        }else{

                            $post->status = Posts::POST_ON_PUBLICATION;

                            $post->save();

                            return 'Снять с публикации';

                        }

                    }else{

                        $post['pay_time'] = time() + 3600;

                        $post->status = Posts::POST_ON_PUBLICATION;

                        $post->save();

                        return 'Снять с публикации';

                    }


                }

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
}