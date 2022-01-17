<?php


namespace frontend\modules\user\controllers;

use common\components\PayLinkBuilder;
use common\models\User;
use common\models\UserBalanceNotification;
use frontend\modules\user\models\Hystory;
use frontend\components\BeforeController as Controller;
use Yii;
use frontend\modules\user\models\forms\PayForm;

class CashController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionPay()
    {

        $data = Yii::$app->request->post();

        $user_data = \explode('_', $data['MERCHANT_ORDER_ID']);

        $user = User::find()->where(['id' => $user_data['0']])->one();

        if ($data['AMOUNT'] >= Yii::$app->params['bonus_sum']){

            $data['AMOUNT'] = $data['AMOUNT'] + (int) ( ($data['AMOUNT'] / 100) * 20 );

        }

        $user->cash = $user->cash + (int) $data['AMOUNT'];

        if ($user->save()) {

            if ($user->status == User::STATUS_INACTIVE) {

                $user->status = User::STATUS_ACTIVE;

                $user->save();

            }

            $history = new Hystory();

            $history->user_id = $user->id;

            $history->sum = (int) $data['AMOUNT'];

            $history->balance = $user->cash;

            $history->type = 'Пополнение баланса';

            $history->timestamp = time();

            $history->save();

            Yii::$app->session->setFlash('success', 'Баланс пополнен');

            if ($user_data[1] == 'moskva')

                Yii::$app->response->redirect('https://e-mass.top/cabinet', 301, false);

            else Yii::$app->response->redirect('https://'.$user_data[1].'.e-mass.top/cabinet', 301, false);

        }



    }

    public function actionRedirect()
    {
        
    }

    public function actionBalance($city)
    {

        $payForm = new PayForm();

        if (!$userBalanceNotification = UserBalanceNotification::find()->where(['user_id' => Yii::$app->user->id])->one()){

            $userBalanceNotification = new UserBalanceNotification();

            $userBalanceNotification->user_id = Yii::$app->user->id;

            $userBalanceNotification->balance_event = 50;

            $userBalanceNotification->is_send_notification = UserBalanceNotification::NOTIFICATION_OPEN;

            $userBalanceNotification->save();

        }

        if ($userBalanceNotification->load(Yii::$app->request->post()) and $userBalanceNotification->validate()){

            Yii::$app->session->setFlash('success','Сохранено');

            $userBalanceNotification->save();

        }


        if ($payForm->load(Yii::$app->request->post()) and $payForm->validate()){

            $payLink = PayLinkBuilder::buildPayLink($city, Yii::$app->user->id, $payForm->sum);

            Yii::$app->response->redirect($payLink, 301, false);

        }

        return $this->render('balance', [
            'city' => $city,
            'payForm' => $payForm,
            'userBalanceNotification' => $userBalanceNotification,
        ]);
    }
}