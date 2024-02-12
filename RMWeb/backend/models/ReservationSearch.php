<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reservation;

/**
 * ReservationSearch represents the model behind the search form of `common\models\Reservation`.
 */
class ReservationSearch extends Reservation
{
    public $userName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tables_number', 'user_id', 'people_number', 'restaurant_id', 'zone_id'], 'integer'],
            [['date_time', 'remarks', 'userName'], 'safe'],
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
        $query = Reservation::find()->joinWith([
            'user' => function ($query) {
                $query->from(['user' => 'user']); // Nome real da tabela 'restaurants'
            }
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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
            'tables_number' => $this->tables_number,
            'user_id' => $this->user_id,
            'date_time' => $this->date_time,
            'people_number' => $this->people_number,
            'restaurant_id' => $this->restaurant_id,
            'zone_id' => $this->zone_id,
        ])
            ->andFilterWhere(['like', 'user.username', $this->userName]);


        return $dataProvider;
    }
}
