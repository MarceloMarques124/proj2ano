<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Zone;

/**
 * ZoneSearch represents the model behind the search form of `common\models\Zone`.
 */
class ZoneSearch extends Zone
{

    public $restaurantName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'restaurant_id', 'capacity'], 'integer'],
            [['name', 'description', 'restaurantName'], 'safe'],
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
        $query = Zone::find()->joinWith(['restaurant' => function ($query) {
            $query->from(['restaurants' => 'restaurants']); // Nome real da tabela 'restaurants'
        }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['restaurantName'] = [
            'asc' => ['restaurants.name' => SORT_ASC],
            'desc' => ['restaurants.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'capacity' => $this->capacity,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'restaurants.name', $this->restaurantName]); // Nome real da tabela 'restaurants'

        return $dataProvider;
    }
}
