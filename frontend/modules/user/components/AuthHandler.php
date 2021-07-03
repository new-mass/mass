<?php

namespace frontend\modules\user\components;

use common\models\User;

use yii\authclient\ClientInterface;
use Yii;
use frontend\modules\user\models\Auth;
use yii\helpers\ArrayHelper;
use frontend\modules\user\models\City;


class AuthHandler
{

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        if (!Yii::$app->user->isGuest) {
            return;
        }

        $attributes = $this->client->getUserAttributes();

        $auth = $this->findAuth($attributes);
        if ($auth) {
            /* @var User $user */
            $user = $auth->user;
            return Yii::$app->user->login($user , 3600 * 24 * 30);
        }
        if ($user = $this->createAccount($attributes)) {

            return Yii::$app->user->login($user ,  3600 * 24 * 30);

        }
    }

    /**
     * @param array $attributes
     * @return Auth
     */
    private function findAuth($attributes)
    {
        $id = ArrayHelper::getValue($attributes, 'id');
        $params = [
            'source_id' => $id,
            'source' => $this->client->getId(),
        ];
        return Auth::find()->where($params)->one();
    }

    /**
     *
     * @param type $attributes
     * @return User|null
     */
    private function createAccount($attributes)
    {
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $name = ArrayHelper::getValue($attributes, 'first_name'). ' '. ArrayHelper::getValue($attributes, 'last_name');

        $cityUrl = $this->prepareCityUrl(Yii::$app->request->headers['host']);

        $cityInfo = City::find()->where(['url' => $cityUrl])->asArray()->one() ;

        $user = $this->createUser($email, $name, $cityInfo['url']);

        $transaction = User::getDb()->beginTransaction();
        if ($user->save()) {

            $auth = $this->createAuth($user->id, $id);
            if ($auth->save()) {

                $transaction->commit();
                return $user;
            }
        }
        $transaction->rollBack();
    }

    private function prepareCityUrl($host){
        $city = \explode('.', $host);
        return $city[0];
    }


    private function createUser($email, $name, $city)
    {
        return new User([
            'username' => $name,
            'email' => $email,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString()),
            'created_at' => $time = time(),
            'updated_at' => $time,
            'status' => 10,
            'city' => $city,
        ]);
    }


    private function createAuth($userId, $sourceId)
    {
        return new Auth([
            'user_id' => $userId,
            'source' => $this->client->getId(),
            'source_id' => (string) $sourceId,
        ]);
    }

}