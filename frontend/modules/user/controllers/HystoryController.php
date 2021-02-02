<?php

namespace frontend\modules\user\controllers;

use Yii;
use frontend\modules\user\models\Hystory;
use frontend\components\BeforeController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HystoryController implements the CRUD actions for Hystory model.
 */
class HystoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Hystory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Hystory();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->user->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hystory model.
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


    /**
     * Finds the Hystory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hystory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hystory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
