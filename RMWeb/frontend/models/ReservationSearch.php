<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Reservation;
use yii\data\ActiveDataProvider;

/**
 * ReservationSearch represents the model behind the search form of `common\models\Reservation`.
 */
class ReservationSearch extends Reservation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tables_number', 'user_id', 'people_number', 'restaurant_id'], 'integer'],
            [['date_time', 'remarks'], 'safe'],
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
        $query = Reservation::find();
        // Adicione uma condição para filtrar as orders do usuário logado
        $query->andWhere(['user_id' => Yii::$app->user->id]);

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
            'tables_number' => $this->tables_number,
            'user_id' => $this->user_id,
            'date_time' => $this->date_time,
            'people_number' => $this->people_number,
            'restaurant_id' => $this->restaurant_id,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
