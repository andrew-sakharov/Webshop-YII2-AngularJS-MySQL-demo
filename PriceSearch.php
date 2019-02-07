<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Price;

/**
 * PriceSearch represents the model behind the search form of `app\models\Price`.
 */
class PriceSearch extends Price
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'users_id', 'plantations_id', 'types_id', 'sorts_id', 'group_id', 'minimum_length', 'quantity', 'price_chargeamount', 'packing_innerpackagequantity'], 'integer'],
            [['create_date', 'update_date', 'is_deleted', 'nl_id', 'nl_product_id', 'flag', 'quality_group', 'quantity_unitcode', 'grower', 'maturity_stage'], 'safe'],
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
        $query = Price::find();

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
            'users_id' => $this->users_id,
            'plantations_id' => $this->plantations_id,
            'types_id' => $this->types_id,
            'sorts_id' => $this->sorts_id,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'group_id' => $this->group_id,
            'minimum_length' => $this->minimum_length,
            'quantity' => $this->quantity,
            'price_chargeamount' => $this->price_chargeamount,
            'packing_innerpackagequantity' => $this->packing_innerpackagequantity,
        ]);

        $query->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'nl_id', $this->nl_id])
            ->andFilterWhere(['like', 'nl_product_id', $this->nl_product_id])
            ->andFilterWhere(['like', 'flag', $this->flag])
            ->andFilterWhere(['like', 'quality_group', $this->quality_group])
            ->andFilterWhere(['like', 'quantity_unitcode', $this->quantity_unitcode])
            ->andFilterWhere(['like', 'grower', $this->grower])
            ->andFilterWhere(['like', 'maturity_stage', $this->maturity_stage]);

        return $dataProvider;
    }
}
