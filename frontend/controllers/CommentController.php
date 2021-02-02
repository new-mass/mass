<?php


namespace frontend\controllers;


use frontend\modules\user\models\Comments;
use frontend\modules\user\models\Posts;
use frontend\components\BeforeController as Controller;

class CommentController extends Controller
{
    public function actionAdd()
    {
        if (\Yii::$app->request->isPost){

            $comment = new Comments();

            if ($comment->load(\Yii::$app->request->post())){

                if ($comment['parent_id']){

                    if (!$post = Posts::find()->where(['id' => $comment['post_id']])->andWhere(['user_id' => \Yii::$app->user->id])->asArray()->one()) exit();

                    else $comment->status = 1;

                }

                $comment->save();

                echo 'Комментарий отправлен';

                exit();

            }

        }

        echo 'Ошибка';
    }
}