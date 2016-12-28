<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MerchantCoupon;

/**
 * MerchantCouponSearch represents the model behind the search form about `app\models\MerchantCoupon`.
 */
class MerchantCouponSearch extends MerchantCoupon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'merchant_id', 'code'], 'integer'],
            [['title', 'merchant'], 'safe'],
        ];
    }

    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * @inheritdoc
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
        $query = MerchantCoupon::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'merchant' => [
                    'asc' => [
                        'merchant.name' => SORT_ASC
                    ],
                    'desc' => [
                        'merchant.name' => SORT_DESC
                    ],
                    'default' => SORT_ASC
                ],
                'title',
                'code'
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'code' => $this->code,
        ]);

        if($this->merchant) {
            $query->joinWith("merchant");
            $query->andFilterWhere(["like", "merchant.name", $this->merchant]);
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
