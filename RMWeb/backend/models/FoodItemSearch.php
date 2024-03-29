<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodItem;

/**
 * FoodItemSearch represents the model behind the search form of `common\models\FoodItem`.
 */
class FoodItemSearch extends FoodItem
{

    public $menuName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu_id'], 'integer'],
            [['name', 'menuName'], 'safe'],
            [['price'], 'number'],
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
        $query = FoodItem::find()->joinWith(['menu' => function ($query) {
            $query->from(['menus' => 'menus']); // Nome real da tabela 'restaurants'
        }]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['menuName'] = [
            'asc' => ['menus.name' => SORT_ASC],
            'desc' => ['menus.name' => SORT_DESC],
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
            'menu_id' => $this->menu_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'menus.name', $this->menuName]);

        return $dataProvider;
    }
}
