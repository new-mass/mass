<?php


namespace frontend\controllers;
use frontend\components\helpers\DayViewHelper;
use frontend\modules\user\components\helpers\ViewPostHelper;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\PostView;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class ViewController extends Controller
{

    public $viewPath = '@app/views/site';

    public function actionGetCount()
    {
        return \frontend\modules\user\components\helpers\ViewPostHelper::getCount();
    }

    public function actionIndex()
    {

        $viewIds = ViewPostHelper::getView();

        $posts = Posts::find()->where(['status' => 1])
            ->andWhere(['in', 'id', $viewIds])
            ->with('avatar')
            ->with('metro')
            ->with('rayon')
            ->orderBy('sorting desc')->asArray()->all();

        DayViewHelper::addViewListing($posts);

        PostView::updateAllCounters(['count' => 1], [ 'in', 'post_id' , ArrayHelper::getColumn($posts, 'id')]);

        $meta = [
            'title' => 'Просмотренные анкеты',
            'des' => 'Просмотренные анкеты',
            'h1' => 'Просмотренные анкеты',
        ];

        Yii::$app->params['meta'] = $meta;

        return $this->render('index', [
            'posts' => $posts,
            'meta' => $meta,
        ]);
    }
}