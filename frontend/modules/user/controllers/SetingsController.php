<?php


namespace frontend\modules\user\controllers;

use yii\web\Controller;

class SetingsController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionIndex($city)
    {
        return $this->render('index');
    }
}