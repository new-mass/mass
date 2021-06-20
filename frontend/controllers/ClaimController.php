<?php


namespace frontend\controllers;

use frontend\models\forms\ClaimForm;
use frontend\components\BeforeController as Controller;
use frontend\modules\user\models\forms\AnketClaimForm;
use frontend\modules\user\models\Posts;
use Yii;
use yii\filters\VerbFilter;

class ClaimController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'add' => ['post'],
                    'claim-anket' => ['post'],
                    'get-anket-modal' => ['post'],
                ],
            ],
        ];
    }

    public function actionAdd()
    {


        $claim = new ClaimForm();

        if ($claim->load(\Yii::$app->request->post()) and $claim->validate() and $claim->save()) {

            \Yii::$app->session->setFlash('success', 'Ваше сообщение отправлено');

        } else {

            \Yii::$app->session->setFlash('error', 'Ой, ошибочка');

        }


        return $this->goHome();

    }

    //get-anket-modal

    public function actionGetAnketModal()
    {

        $claimForm = new AnketClaimForm();

        $id = Yii::$app->request->post('id');

        return $this->renderFile('@app/views/claim/claim-form.php', [
            'claimForm' => $claimForm,
            'id' => $id,
        ]);
    }

    public function actionClaimAnket()
    {
        $claimForm = new AnketClaimForm();

        if ($claimForm->load(Yii::$app->request->post()) and $claimForm->validate() and $claimForm->save()) {

            $post = Posts::findOne($claimForm->post_id);

            Yii::$app->session->setFlash('success', 'Жалоба отправлена на обработку');

            return $this->redirect('/anketa/' . $post['url']);

        }

        Yii::$app->session->setFlash('warning', 'Ошибка');

        return $this->redirect('/');

    }

}