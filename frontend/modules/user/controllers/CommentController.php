<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\models\Comments;
use frontend\modules\user\models\Posts;
use yii\web\Controller;
Use yii\filters\VerbFilter;

class CommentController extends Controller
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

    public function actionHide()
    {
        if ($comment = Comments::find()->where(['id' => \Yii::$app->request->post('id')])->with('post')->one()
        and ($comment['post']['user_id'] == \Yii::$app->user->id or $comment['post']['old_user_id'] == \Yii::$app->user->identity->old_id)){

            $comment->status = Comments::COMMENT_HIDE;

            $comment->save();

            Posts::deletePostCache($comment->post_id);

        }
    }

    public function actionShow()
    {
        if ($comment = Comments::find()->where(['id' => \Yii::$app->request->post('id')])->with('post')->one()
        and ($comment['post']['user_id'] == \Yii::$app->user->id or $comment['post']['old_user_id'] == \Yii::$app->user->identity->old_id)){

            $comment->status = Comments::COMMENT_ON_PUBLICATION;

            $comment->save();

            Posts::deletePostCache($comment->post_id);

        }
    }
}