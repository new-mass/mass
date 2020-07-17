<?php


namespace frontend\controllers;
use frontend\components\helpers\PhotoHelper;
use yii\web\Controller;

class PhotoController extends Controller
{
    public function actionGetPhoto()
    {
        if (\Yii::$app->request->isPost){

            $post = \Yii::$app->request->post();

            if ($post['position'] == -1) return PhotoHelper::getAvatar($post['id']);

            else return PhotoHelper::getPhoto($post['id'], $post['position']);

        }

        return false;
    }
}