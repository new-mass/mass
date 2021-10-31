<?php
namespace frontend\controllers;

use common\models\Webmaster;
use frontend\components\helpers\DayViewHelper;
use frontend\components\helpers\PageHelper;
use frontend\components\helpers\PhoneViewHelper;
use frontend\components\helpers\PostOrderHelper;
use frontend\models\forms\SearchForm;
use frontend\models\PageMeta;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\modules\user\components\helpers\SaveNameHelper;
use frontend\modules\user\models\City;
use frontend\modules\user\models\MassagDlya;
use frontend\modules\user\models\Metro;
use frontend\modules\user\models\PhoneView;
use frontend\modules\user\models\Place;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\PostView;
use frontend\modules\user\models\Rayon;
use frontend\modules\user\models\Service;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\components\helpers\QueryParamsHelper;
use frontend\components\BeforeController as Controller;
use frontend\modules\user\components\AuthHandler;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'frontend\components\AuthAction',
                'city' => Yii::$app->controller->actionParams['city'],
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'thumb' => 'iutbay\yii2imagecache\ThumbAction',
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();

        if (!Yii::$app->user->isGuest) return $this->redirect('/cabinet');

    }

    /**
     * Displays homepage.
     *
     * @param string $city
     * @return mixed
     */
    public function actionIndex($city = 'moskva' )
    {

        if (Yii::$app->request->get('show')) return $this->redirect('/', 301);

        if (strpos(Yii::$app->request->url, 'show'))
            return $this->redirect(strstr(Yii::$app->request->url, '?show', true), 301);

        $city_name = $city;

        $city = Yii::$app->cache->get('city_'.$city_name);

        if ($city === false) {

            $city = City::find()->where(['name' => $city_name])->asArray()->one();

            Yii::$app->cache->set('city_'.$city_name, $city);

        }

        $uri = PageHelper::cropUriParams($_SERVER['REQUEST_URI']);

        $meta = Yii::$app->cache->get('meta_'.$city_name.'_'.$uri);

        if ($meta === false) {

            $meta = PageMeta::find()->where(['page_name' => $uri, 'city_id' =>$city['id']])->asArray()->one();

            Yii::$app->cache->set('meta_'.$city_name.'_'.$uri, $meta );

        }

        $posts = Posts::find()->where(['status' => 1])->andWhere(['city_id' => $city['id']])->limit(Yii::$app->params['post_limit']);

        $countQuery = clone $posts;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'forcePageParam' => false]);

        $pages->defaultPageSize = Yii::$app->params['post_limit'];

        $posts = $posts->with('avatar')
            ->with('metro')
            ->with('rayon')
            ->with('video')
            ->offset($pages->offset)
            ->orderBy(PostOrderHelper::getOrderAndSetOrderCookie());

        DayViewHelper::addViewListing($posts);

        $posts = $posts->asArray()->all();

        PostView::updateAllCounters(['count' => 1], [ 'in', 'post_id' , ArrayHelper::getColumn($posts, 'id')]);

        $tag = Webmaster::getTag($city['id']);

        Yii::$app->params['meta'] = $meta;

        $main = true;

        return $this->render('index', [
            'posts' => $posts,
            'meta' => $meta,
            'main' => $main,
            'pages' => $pages,
            'tag' => $tag,
            'city' => $city,
            ]);
    }

    public function actionFilter( $city= 'moskva', $param)
    {

        if (Yii::$app->request->get('show'))
            return $this->redirect(strstr(Yii::$app->request->url, '?show', true), 301);

        if (strpos(Yii::$app->request->url, 'show'))
            return $this->redirect(strstr(Yii::$app->request->url, '?show', true), 301);

        if($city == 'spb' and strstr(Yii::$app->request->url , 'massazh-dlya_muzhchin-spb' )){
            header('Location: /massazh-dlya_muzhchin', true, 301);
            exit();
        }

        if($city == 'spb' and strstr(Yii::$app->request->url , 'ehroticheskij_massazh-spb' )){
            header('Location: /service_eroticheskiy', true, 301);
            exit();
        }

        $uri = PageHelper::cropUriParams($_SERVER['REQUEST_URI']);

        $city = City::getCity($city);

        $posts = QueryParamsHelper::getParams($param, $city, Yii::$app->params['post_limit']);

        if ($posts){

            $countQuery = clone $posts;

            $pages = new Pagination(['totalCount' => $countQuery->count(), 'forcePageParam' => false]);

            $pages->defaultPageSize = Yii::$app->params['post_limit'];

            $posts = $posts->offset($pages->offset)->orderBy(PostOrderHelper::getOrderAndSetOrderCookie())->asArray()->all();

        }

        $meta = Yii::$app->cache->get('meta_'.$city['value'].'_'.$uri);

        if ($meta === false) {

            $meta = PageMeta::find()->where(['page_name' => $uri, 'city_id' =>$city['id']])->asArray()->one();

            Yii::$app->cache->set('meta_'.$city['value'].'_'.$uri, $meta );

        }

        if ($posts){

            DayViewHelper::addViewListing($posts);

            PostView::updateAllCounters(['count' => 1], [ 'in', 'post_id' , ArrayHelper::getColumn($posts, 'id')]);

        }

        Yii::$app->params['meta'] = $meta;

        $more_posts = false;

        if(\count($posts) < 6) $more_posts = Posts::find()->limit(8)
            ->where(['city_id' => $city['id']])
            ->andWhere(['status' => Posts::POST_ON_PUBLICATION])
            ->orderBy(['rand()' => SORT_DESC])
            ->all();


        if ($meta)

        return $this->render('index', [
            'posts' => $posts,
            'city' => $city,
            'param' => $param,
            'meta' => $meta,
            'more_posts' => $more_posts,
            'pages' => $pages,
        ]);

        else {

            Yii::$app->response->statusCode = 404;

            return $this->render('error', [
                'message' => 'Такой страницы нет'
            ]);

        }


    }

    public function actionNew($city = 'moskva')
    {

        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

        $city = City::getCity($city);

        $posts = Posts::find()->where(['status' => 1])
            ->andWhere(['city_id' => $city['id']])
            ->with('video')
            ->with('avatar')->orderBy('id desc')->asArray()->all();

        return $this->renderFile(Yii::getAlias('@app/views/site/new.php' ), [
            'posts' => $posts
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionCust()
    {
        echo SaveNameHelper::save('anton');
    }

    public function actionPhone()
    {
        if (Yii::$app->request->isPost){

            PhoneViewHelper::addView(Yii::$app->request->post('id'));

            return PhoneView::updateAllCounters(['count' => 1], [ 'in', 'post_id' ,Yii::$app->request->post('id')]);

        }

        return $this->goHome();
    }

    public function actionSearch($city = 'moskva')
    {

        if (Yii::$app->request->isPost){

            $searchModel = new SearchForm();

            if ($searchModel->load(Yii::$app->request->post()) and $searchModel->validate()){

                $meta['title'] = 'Поиск по имени '.$searchModel->name;
                $meta['des'] = 'Поиск по имени '.$searchModel->name;
                $meta['h1'] = 'Поиск по имени '.$searchModel->name;

                Yii::$app->params['meta'] = $meta;

                $posts = Posts::find()->where(['like', 'name', $searchModel->name])->with('avatar')
                    ->andWhere(['status' => Posts::POST_ON_PUBLICATION])
                    ->with('metro')
                    ->with('rayon')
                    ->with('video')
                    ->orderBy('check_photo_status desc, video_sort desc, sorting desc')->asArray()->all();

                DayViewHelper::addViewListing($posts);

                PostView::updateAllCounters(['count' => 1], [ 'in', 'post_id' , ArrayHelper::getColumn($posts, 'id')]);;

                return $this->render('index', [
                    'posts' => $posts,
                    'meta' => $meta,
                ]);


            }

        }
        return $this->goHome();
    }

    public function actionNewPost($city = 'moskva')
    {
        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

        $city = City::getCity($city);

        $posts = Posts::find()->where(['status' => 1])
            ->andWhere(['city_id' => $city['id']])
            ->with('avatar')
            ->with('metro')
            ->with('rayon')
            ->with('video')
            ->limit(Yii::$app->params['post_limit'])
            ->orderBy('id desc')->asArray()->all();

        $meta['h1'] = 'Новые анкеты';
        $meta['title'] = 'Новые анкеты';
        $meta['des'] = 'Новые анкеты';

        DayViewHelper::addViewListing($posts);

        PostView::updateAllCounters(['count' => 1], [ 'in', 'post_id' , ArrayHelper::getColumn($posts, 'id')]);

        return $this->render('index', [
            'posts' => $posts,
            'city' => $city,
            'meta' => $meta,
        ]);
    }

    public function actionRobot($city = 'moskva')
    {
        if ($city == 'moskva') $host = Yii::$app->params['site_name'];

        else $host = $city . '.' . Yii::$app->params['site_name'];

        return $this->renderFile('@app/views/site/robot.php', [
            'host' => $host
        ]);
    }

    public function actionMap($city)
    {

        $cityInfo = City::getCity($city);

        $metro = Metro::find()->where(['city_id' => $cityInfo['id']])->asArray()->all();
        $rayon = Rayon::find()->where(['city_id' => $cityInfo['id']])->asArray()->all();
        $service = Service::find()->asArray()->all();

        $massgDlya = MassagDlya::find()->all();
        $place = Place::find()->all();

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');

        $posts = Posts::find()->where(['city_id' => $cityInfo['id']])->asArray()->all();

        return $this->renderFile(Yii::getAlias('@frontend/views/site/map.php'), [
            'metro' => $metro,
            'rayon' => $rayon,
            'service' => $service,
            'place' => $place,
            'massgDlya' => $massgDlya,
            'posts' => $posts,
        ]);

    }

    public function actionGetMorePost($city = 'moskva')
    {

        $city = preg_replace('#[^\\/\-a-z\s]#i', '', $city);

        $city = City::getCity($city);

        $params = Yii::$app->request->post();

        $offset = $params['offset'];

        if($params['url'] == '/'){

            $posts = Posts::find()->where(['status' => 1])
                ->with('avatar')
                ->andWhere(['city_id' => $city['id']])
                ->with('metro')
                ->with('rayon')
                ->with('video')
                ->limit(Yii::$app->params['post_limit'])
                ->offset($offset)
                ->orderBy(PostOrderHelper::getOrderAndSetOrderCookie())->asArray()->all();

        }elseif($params['url'] == '/new'){

            $posts = Posts::find()->where(['status' => 1])
                ->andWhere(['city_id' => $city['id']])
                ->with('avatar')
                ->with('metro')
                ->with('rayon')
                ->with('video')
                ->orderBy('id desc')
                ->limit(Yii::$app->params['post_limit'])
                ->offset($offset)
                ->asArray()->all();

        }else{

            $posts = QueryParamsHelper::getParams($params['url'], $city, Yii::$app->params['post_limit'], $offset);

            $posts = $posts->orderBy(PostOrderHelper::getOrderAndSetOrderCookie())->asArray()->all();

        }

        $page = PageHelper::getPageNumber(Yii::$app->params['post_limit'],$offset );

        $pageUrl = PageHelper::getUrl($params['url'], $page + 1);

        DayViewHelper::addViewListing($posts);

        PostView::updateAllCounters(['count' => 1], [ 'in', 'post_id' , ArrayHelper::getColumn($posts, 'id')]);

        if ($posts) return $this->renderFile('@app/views/site/more.php', [
            'posts' => $posts,
            'page' => $page,
            'pageUrl' => $pageUrl,
        ]);

        return false;
    }

    public function actionRedirect($page)
    {

        $newUrl = str_replace('/page-'.$page, '?page='.$page, strstr(Yii::$app->request->url, '?page=', true) ?: Yii::$app->request->url);

        if (strpos($newUrl, '/') === false) $newUrl = '/'.$newUrl;

        return $this->redirect($newUrl, 301);
    }

    public function actionGetClaimModal()
    {
        return \frontend\widgets\ClaimFormWidget::widget();
    }

}
