<?php


namespace frontend\modules\user\controllers;

use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\modules\user\models\City;
use yii\web\Controller;
use Yii;

class UserController extends Controller
{
    public function actionLogin($city = 'moskva')
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $modelLogin = new LoginForm();
        $modelSign = new SignupForm();

        $cityInfo = City::find()->where(['name' => $city])->asArray()->one();



        $modelLogin->city_id = $cityInfo['id'];

        if ($modelLogin->load(Yii::$app->request->post()) && $modelLogin->login()) {

            return $this->redirect('/cabinet');

        } else {
            $modelLogin->password = '';

            return $this->render('login', [
                'model' => $modelLogin,
                'modelSign' => $modelSign,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister(){

        $modelSign = new SignupForm();
        if ($modelSign->load(Yii::$app->request->post()) && $user = $modelSign->signup() and Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Регистрация прошла успешно, Вам отправлено письмо с подтверждением почты');
            return $this->redirect('/cabinet');
        }

        return $this->redirect('/cabinet/login');

    }
}