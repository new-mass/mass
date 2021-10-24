<?php


namespace console\controllers;

use common\components\HystoryHelper;
use common\models\User;
use common\models\UserBalanceNotification;
use frontend\modules\user\models\Hystory;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\Tarif;
use yii\console\Controller;
use Yii;

class PayController extends Controller
{
    public function actionIndex()
    {
        if ($posts = Posts::find()->where(['<', 'pay_time', time()])->andWhere(['status' => Posts::POST_ON_PUBLICATION])->all()) {

            foreach ($posts as $post) {

                if ($post['old_user_id']) {

                    $user = User::find()
                        ->where(['old_id' => $post['old_user_id']])
                        ->andWhere(['city_id' => $post['city_id']])->one();

                } else {

                    $user = User::find()->where(['id' => $post['user_id']])
                        ->andWhere(['city_id' => $post['city_id']])->one();

                }

                $tarif = Tarif::find()->where(['value' => $post['tarif_id']])->asArray()->one();

                if ($user and $user->cash >= $tarif['value']) {

                    if ($tarif['value'] > 0) {

                        //если фото проверенно то делаем скидку
                        if ($post['check_photo_status'] == Posts::PHOTO_CHECK and $tarif['value'] >= 2) {

                            $paySum = $tarif['value'] - 1;

                        } else {

                            $paySum = $tarif['value'];

                        }

                        $user->cash = $user->cash - $paySum;

                        if ($user->save()) {

                            $post['pay_time'] = time() + (3600 * 24);

                            $post->save();

                            HystoryHelper::add(
                                $user->id,
                                $paySum,
                                $user->cash,
                                'Публикация анкеты ' . $post['name'] . ' id ' . $post['id']);

                            if ($userNotification = UserBalanceNotification::find()
                                ->where(['user_id' => $user->id])
                                ->one()) {
                                if ($user->cash <= $userNotification->balance_event
                                    and $userNotification->is_send_notification == UserBalanceNotification::NOTIFICATION_OPEN
                                    and $userNotification->last_notification_send < (time() - 3600)) {

                                    if (Yii::$app->mailer->compose()
                                        ->setFrom(Yii::$app->params['admin_email'])
                                        ->setTo($user['email'])
                                        ->setSubject('Уведомление о низком балансе на сайте e-mass')
                                        ->setTextBody('На Вашем балансе осталось ' . $user->cash . ' руб. Что бы отключить уведомления перейдите в раздел "Пополнить баланс"')
                                        ->setHtmlBody('<p>На Вашем балансе осталось ' . $user->cash . ' руб. Что бы отключить уведомления перейдите в раздел "Пополнить баланс"</p>')
                                        ->send()) {
                                        $userNotification->last_notification_send = time();

                                        $userNotification->save();
                                    }

                                }

                            } else {

                                $userNotification = new UserBalanceNotification();

                                $userNotification->last_notification_send = 0;

                                $userNotification->user_id = $user->id;

                                $userNotification->save();

                            }

                        }

                    } else {

                        $post['pay_time'] = time() + 3600;
                        $post['sorting'] = rand(0, 50);

                        $post->save();

                    }

                } else {

                    if ($user) {

                        $post->status = Posts::POST_DONT_PUBLICATION;

                        $post->save();

                        $user = User::find()->where(['id' => $post['user_id']])->one();

                        Yii::$app->mailer->compose()
                            ->setFrom(Yii::$app->params['admin_email'])
                            ->setTo($user['email'])
                            ->setSubject('Остановка публикации анкеты на сайте e-mass')
                            ->setTextBody('Анкета ' . $post['name'] . ' снята с публикации из за низкого баланса')
                            ->setHtmlBody('<p>Анкета ' . $post['name'] . ' снята с публикации из за низкого баланса</p>')
                            ->send();

                    }


                }

            }

        }
    }
}