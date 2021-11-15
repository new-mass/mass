<?php


namespace frontend\modules\user\controllers;

use common\models\LoginForm;
use common\models\User;
use frontend\models\SignupForm;
use frontend\modules\user\models\City;
use frontend\components\BeforeController as Controller;
use Yii;

class UserController extends Controller
{
    public function actionLogin($city = 'moskva')
    {

        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

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

            if (Yii::$app->request->isPost and $user = User::find()->where(['email' => $modelLogin->email])->one()){

                $cityInfo = City::find()->where(['id' => $user->city_id])->one();

                if ($cityInfo->name == 'moskva') return $this->redirect('https://e-mass.top/cabinet/login');

                else return $this->redirect('https://'.$cityInfo->name.'.e-mass.top/cabinet/login');

            }

            $modelLogin->password = '';

        }

        return $this->render('login', [
            'model' => $modelLogin,
            'modelSign' => $modelSign,
        ]);

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

    public function actionRegister($city = 'moskva'){

        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

        $cityInfo = City::getCity($city);

        $modelSign = new SignupForm();

        if (Yii::$app->request->isPost){

            if ( !$_POST['g-recaptcha-response'] ){

                Yii::$app->session->setFlash('warning', 'Нужно заполнить капчу');

                return $this->redirect('/cabinet/login');

            }

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $key = '6Led3OgUAAAAAM45wrjpjCGEw8DDn_B62d-jTXrK';
            $query = $url.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];

            $data = json_decode(file_get_contents($query));

            if ( $data->success == false) {

                Yii::$app->session->setFlash('warning', 'Капча заполнена не верно');

                return $this->redirect('/cabinet/login');

            }

        }

        $modelSign->city_id = $cityInfo['id'];

        if ($modelSign->load(Yii::$app->request->post()) && $user = $modelSign->signup() and Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Регистрация прошла успешно, Вам отправлено письмо с подтверждением почты');
            return $this->redirect('/cabinet');
        }

        return $this->redirect('/cabinet/login');

    }
}