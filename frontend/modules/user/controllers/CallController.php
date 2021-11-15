<?php

namespace frontend\modules\user\controllers;

use common\models\RequestCall;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CallController extends Controller
{
    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'hide'  => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $requestCallList = RequestCall::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->orderBy('id DESC')
            ->all();

        RequestCall::setRead(\Yii::$app->user->id);

        return $this->render('index', [
            'requestCallList' => $requestCallList
        ]);

    }

}