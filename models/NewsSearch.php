<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News;
use app\components\UserHelperClass;

/**
 * NewsSearch represents the model behind the search form of `app\models\News`.
 */
class NewsSearch extends News
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'active'], 'integer'],
            [['create_date', 'title', 'preview_text', 'detail_text'], 'safe'],
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

        $query = News::find();

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
            'cat_id' => $this->cat_id,
            'active' => $this->active,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'preview_text', $this->preview_text])
            ->andFilterWhere(['like', 'detail_text', $this->detail_text]);

        return $dataProvider;
    }
}
