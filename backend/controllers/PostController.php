<?php

namespace backend\controllers;

use common\components\HystoryHelper;
use common\models\User;
use frontend\modules\user\models\Tarif;
use Yii;
use app\models\Posts;
use app\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Posts model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            \backend\components\behaviors\isAdminAuth::class,
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCheck()
    {
        if (Yii::$app->request->isPost){

            $id = Yii::$app->request->post('id');

            if ($post = Posts::find()->where(['id' => $id])->one()){

                if ($post->tarif_id > 0){

                    if ($post->pay_time < time() ){

                        $tarif = Tarif::find()->where(['value' => $post['tarif_id']])->asArray()->one();

                        $user = User::find()->where(['id' => $post['user_id']])->one();

                        if ($user->cash >=  $tarif['value']){

                            $user->cash = $user->cash - $tarif['value'];

                            if ($user->save()){

                                $post['pay_time'] = time() + 3600;

                                $post->status = \frontend\modules\user\models\Posts::POST_ON_PUBLICATION;

                                $post->save();

                                HystoryHelper::add($user->id, $tarif['value'], $user->cash, 'Публикация анкеты '.$post['name'].' id '.$post['id']);

                            }

                        }else{

                            $post->status = \frontend\modules\user\models\Posts::POST_DONT_PUBLICATION;

                            $post->save();

                        }

                    }else{

                        $post->status = Posts::POST_ON_PUBLICATION;

                        $post->save();

                    }

                }else{

                    $post['pay_time'] = time() + 3600;

                    $post->status = Posts::POST_ON_PUBLICATION;

                    $post->save();

                }

            }

            $user = User::find()->where(['id' => $post['user_id']])->one();

            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['admin_email'])
                ->setTo($user['email'])
                ->setSubject('Подтверждение анкеты')
                ->setTextBody('Анкета '.$post['name'].' подтверждена')
                ->setHtmlBody('<p>Анкета '.$post['name'].' подтверждена</p>')
                ->send();

        }
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::find()->where(['id' => $id])->with('avatar', 'gallery')->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
