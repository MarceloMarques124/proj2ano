<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Order;
use yii\data\ActiveDataProvider;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    public $restaurantName;
    public $userName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'restaurant_id', 'state'], 'integer'],
            [['price'], 'number'],
            [['userName', 'restaurantName'], 'safe'],
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
        //$query = Order::find();
        // Adicione uma condição para filtrar as orders do usuário logado
        //$query->andWhere(['user_id' => Yii::$app->user->id]);
        $query = Order::find()->joinWith([
            'restaurant' => function ($query) {
                $query->from(['restaurants' => 'restaurants']); // Nome real da tabela 'restaurants'
            },
            'user' => function ($query) {
                $query->from(['user' => 'user']); // Nome real da tabela 'restaurants'
            }
        ]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['restaurantName'] = [
            'asc' => ['restaurants.name' => SORT_ASC],
            'desc' => ['restaurants.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['userName'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'state' => $this->state,
        ])
            ->andFilterWhere(['like', 'restaurants.name', $this->restaurantName])
            ->andFilterWhere(['like', 'user.username', $this->restaurantName]);


        return $dataProvider;
    }
}
