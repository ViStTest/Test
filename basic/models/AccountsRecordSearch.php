<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AccountsRecordSearch represents the model behind the search form about `app\models\AccountsRecord`.
 */
class AccountsRecordSearch extends AccountsRecord
{
    public $usr_name;
    public $usr_email;
    public $usr_address;

    public $added_from;
    public $added_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'account', 'user_id'], 'integer'],
            [['usr_name', 'usr_email', 'usr_address', 'added_from', 'added_to'], 'safe'],
        ];
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
        $query = AccountsRecord::find()->joinWith('user', ['id' => 'user_id']);

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
            'AND',
            ['like', 'account', $this->account],
            ['users.usr_name' => $this->usr_name],
            ['users.usr_email' => $this->usr_email],
            ['users.usr_address' => $this->usr_address],
        ]);

        if ($this->added_from)
        {
            $query->andFilterWhere(['>=', 'added', strtotime($this->added_from)]);
        }

        if ($this->added_to)
        {
            $query->andFilterWhere(['<=', 'added', strtotime($this->added_to)]);
        }

        return $dataProvider;
    }
}
