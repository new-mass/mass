<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Posts;

/**
 * PostsSearch represents the model behind the search form of `app\models\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'user_id', 'tarif_id', 'created_at', 'updated_at', 'sorting', 'work_time', 'age', 'breast', 'ves', 'rost', 'price', 'price_2_hour', 'status', 'pay_time'], 'integer'],
            [['name', 'phone', 'about', 'url'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Posts::find()->orderBy(['status' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'city_id' => $this->city_id,
            'user_id' => $this->user_id,
            'tarif_id' => $this->tarif_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'sorting' => $this->sorting,
            'work_time' => $this->work_time,
            'age' => $this->age,
            'breast' => $this->breast,
            'ves' => $this->ves,
            'rost' => $this->rost,
            'price' => $this->price,
            'price_2_hour' => $this->price_2_hour,
            'status' => $this->status,
            'pay_time' => $this->pay_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
