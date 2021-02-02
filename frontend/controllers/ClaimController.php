<?php


namespace frontend\controllers;

use frontend\models\forms\ClaimForm;
use frontend\components\BeforeController as Controller;

class ClaimController extends Controller
{
    public function actionAdd()
    {
        if (\Yii::$app->request->isPost){

            $claim = new ClaimForm();

            if ($claim->load(\Yii::$app->request->post()) and $claim->validate() and $claim->save()){

                \Yii::$app->session->setFlash('success', 'Ваше сообщение отправлено');

            }else{

                \Yii::$app->session->setFlash('error', 'Ой, ошибочка');

            }

        }

        return $this->goHome();

    }
}