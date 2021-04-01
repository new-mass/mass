<?php


namespace frontend\modules\user\components\helpers;


use common\components\HystoryHelper;
use common\models\User;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\Tarif;

class PublicationHelper
{

    private $post;
    private $user;
    private $statusPostPublication;
    private $statusUpAnket;

    public function __construct($id)
    {

        if ($post = Posts::find()->where(['id' => $id])->one()) {

            $this->post = $post;

            if (!$this->user = \Yii::$app->user->identity)
                throw new \Exception('Пользователь не найден');

        }

        else throw new \Exception('Анкета не найдена');

    }

    public function upAnket()
    {

        if ((time() - $this->post->sorting) < 60 ) throw new \Exception('Поднимать можно один раз в 60 сек');

        if ($this->user->cash <= \Yii::$app->params['up_anket_cost'] )
            throw new \Exception('Недостаточно средств');

        $this->user->cash = $this->user->cash - \Yii::$app->params['up_anket_cost'];

        $this->user->save();

        $this->post->sorting = time();

        if ($this->post->status == Posts::POST_DONT_PUBLICATION) $this->startPublication();

        else{

            $this->post->save();

            HystoryHelper::add($this->user->id, \Yii::$app->params['up_anket_cost'], $this->user->cash, 'Поднятие анкеты ' . $this->post->name . ' id ' . $this->post->id);

            $this->statusUpAnket = 'Анкета поднята';

        }

        return $this;

    }

    public function startPublication()
    {

        if ($this->post->status == Posts::POST_ON_PUBLICATION) {

            $this->post->status = Posts::POST_DONT_PUBLICATION;

            $this->post->save();

            $this->statusPostPublication = 'Поставить на публикацию';

        }

        elseif ($this->post->status == Posts::POST_DONT_PUBLICATION) {

            if ($this->post->tarif_id > 0) {

                if ($this->post->pay_time < time()) {

                    $tarif = Tarif::find()->where(['value' => $this->post->tarif_id])->asArray()->one();

                    if ($this->user->cash >= $tarif['value']) {

                        $this->user->cash = $this->user->cash - $tarif['value'];

                        if ($this->user->save()) {

                            $this->post->pay_time = time() + 3600;

                            $this->post->status = Posts::POST_ON_PUBLICATION;

                            $this->post->save();

                            HystoryHelper::add($this->user->id, $tarif['value'], $this->user->cash, 'Публикация анкеты ' . $this->post->name . ' id ' . $this->post->id);

                            $this->statusPostPublication = 'Снять с публикации';

                        }

                    } else {

                        $this->statusPostPublication = 'Недостаточно средств';

                    }

                } else {

                    $this->post->status = Posts::POST_ON_PUBLICATION;

                    $this->post->save();

                    $this->statusPostPublication = 'Снять с публикации';

                }

            } else {

                $this->post->pay_time = time() + 3600;

                $this->post->status = Posts::POST_ON_PUBLICATION;

                $this->post->save();

                $this->statusPostPublication = 'Снять с публикации';

            }


        }

        else throw new \Exception('Ошибка');

        return $this;

    }

    /**
     * @return mixed
     */
    public function getStatusPostPublication()
    {
        return $this->statusPostPublication;
    }

    /**
     * @return mixed
     */
    public function getStatusUpAnket()
    {
        return $this->statusUpAnket;
    }

}