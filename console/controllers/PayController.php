<?php


namespace console\controllers;
use common\components\HystoryHelper;
use common\models\User;
use frontend\modules\user\models\Hystory;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\Tarif;
use yii\console\Controller;
use Yii;

class PayController extends Controller
{
    public function actionIndex()
    {
        if ($posts = Posts::find()->where([ '<', 'pay_time', time()])->all()){

            foreach ($posts as $post){

                $user = User::find()->where(['id' => $post['user_id']])->orWhere(['old_id' => $post['old_user_id']])
                    ->andWhere(['city_id' => $post['city_id']])->one();

                $tarif = Tarif::find()->where(['value' => $post['tarif_id']])->asArray()->one();

                if ($user->cash >=  $tarif['value']){

                    if ($tarif['value'] > 0){

                        $user->cash = $user->cash - $tarif['value'];

                        if ($user->save()){

                            $post['pay_time'] = time() + 3600;

                            $post->save();

                            HystoryHelper::add($user->id, $tarif['value'], $user->cash, 'Публикация анкеты '.$post['name'].' id '.$post['id']);

                        }

                    }else{

                        $post['pay_time'] = time() + 3600;

                        $post->save();

                    }

                }else{

                    $post->status = Posts::POST_DONT_PUBLICATION;

                    $post->save();

                    $user = User::find()->where(['id' => $post['user_id']])->one();

                    Yii::$app->mailer->compose()
                        ->setFrom(Yii::$app->params['admin_email'])
                        ->setTo($user['email'])
                        ->setSubject('Остановка публикации анкеты на сайте e-mass')
                        ->setTextBody('Анкета '.$post['name'].' снята с публикации из за низкого баланса')
                        ->setHtmlBody('<p>Анкета '.$post['name'].' снята с публикации из за низкого баланса</p>')
                        ->send();

                }

            }

        }
    }
}