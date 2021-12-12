<?php

namespace console\components\helpers;

use common\components\PayLinkBuilder;
use common\models\User;
use frontend\modules\user\models\City;
use Yii;
use yii\helpers\Html;

class MailHelper
{
    public static function stopPuplicationMessage(User $user, $post)
    {

        $city = City::find()->where(['id' => $user['city_id']])->one();

        $payBalanceText = self::payBalanceText($city['name'], $user['id'], Yii::$app->params['pay_email_sum']);

        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['admin_email'])
            ->setTo($user['email'])
            ->setSubject('Остановка публикации анкеты на сайте e-mass')
            ->setTextBody('Анкета ' . $post['name'] . ' снята с публикации из за низкого баланса '.$payBalanceText )
            ->setHtmlBody('<p>Анкета ' . $post['name'] . ' снята с публикации из за низкого баланса</p>'.$payBalanceText)
            ->send();
    }

    public static function payBalanceText($city, $userId, $sum) : string
    {
        return Html::a('Пополнить счет на '.$sum.' руб ', PayLinkBuilder::buildPayLink($city, $userId, $sum));
    }

    public static function lowBalanceMessage(User $user)
    {
        $city = City::find()->where(['id' => $user['city_id']])->one();

        $payBalanceText = self::payBalanceText($city['name'], $user['id'], Yii::$app->params['pay_email_sum']);

        return Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['admin_email'])
            ->setTo($user['email'])
            ->setSubject('Уведомление о низком балансе на сайте e-mass')
            ->setTextBody('На Вашем балансе осталось ' . $user->cash . ' руб. Что бы отключить уведомления перейдите в раздел "Пополнить баланс"' .$payBalanceText)
            ->setHtmlBody('<p>На Вашем балансе осталось ' . $user->cash . ' руб. Что бы отключить уведомления перейдите в раздел "Пополнить баланс"</p>' . $payBalanceText)
            ->send();
    }

}