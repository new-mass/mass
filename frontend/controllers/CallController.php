<?php

namespace frontend\controllers;

use common\models\RequestCall;
use common\models\User;
use frontend\modules\user\models\Posts;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class CallController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'get' => ['post'],
                    'add' => ['post'],
                ],
            ],
        ];
    }

    public function actionGet()
    {
        $callForm = new RequestCall();

        $id = Yii::$app->request->post('id');

        return $this->renderFile('@app/views/call/get-call-form.php', [
            'callForm' => $callForm,
            'id' => $id,
        ]);
    }

    public function actionAdd()
    {
        $callForm = new RequestCall();

        if ($callForm->load(Yii::$app->request->post())){

            if ($post = Posts::findOne(['id' => $callForm->post_id])){

                if (!$post['old_user_id']) $user = User::findOne(['id' => $post['user_id']]);
                else $user = User::findOne(['old_id' => $post['old_user_id']]);

                if ($user){

                    $callForm->user_id = $user->id;

                    if ($callForm->validate() and $callForm->save()){

                        Yii::$app->session->setFlash('success', 'Заказ на звонок добавлен');

                    }


                }

                else Yii::$app->session->setFlash('warning', 'Ошибка, попробуйте еще раз');;

            }

        }else{

            Yii::$app->session->setFlash('warning', 'Ошибка, попробуйте еще раз');

        }

        return $this->goBack();

    }

}