<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserCoupon;

/**
 * UserCouponSearch represents the model behind the search form about `app\models\UserCoupon`.
 */
class UserCouponSearch extends UserCoupon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'code'], 'integer'],
            [['title', 'user'], 'safe'],
        ];
    }

    public function setUser($user)
    {
        $this->user = $user;
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
        $query = UserCoupon::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'user' => [
                    'asc' => [
                        'user.name' => SORT_ASC
                    ],
                    'desc' => [
                        'user.name' => SORT_DESC
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
            'id' => $this->id,
            'code' => $this->code,
        ]);

        if($this->user) {
            $query->joinWith("user");
            $query->andFilterWhere(["like", "user.name", $this->user]);
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
