<?php

namespace backend\components\behaviors;

use yii\base\Behavior;
use Yii;

class isAdminAuth extends Behavior
{
    public function events()
    {
        return [
            yii\web\Controller::EVENT_BEFORE_ACTION => 'checkAuth'
        ];
    }

    public function checkAuth(){

        if (Yii::$app->user->isGuest or Yii::$app->user->identity['role'] != 'admin') {

            Yii::$app->user->logout();

            Yii::$app->response->redirect(['/site/login'], 301, false);

        }

    }
}