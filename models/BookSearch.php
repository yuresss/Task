<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BookSearch represents the model behind the search form of `app\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * {@inheritdoc}
     */
    public $autorName;//Переменная для хранения имени автора
    public function rules()
    {
        return [
            [['id', 'autor_id'], 'integer'],
            [['name', 'edition', 'description', 'autorName'], 'safe'],
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
        $query = Book::find();
        $query->joinWith(['autor']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['autorName'] = [
            'asc' => [Autor::tableName() . '.name' => SORT_ASC],
            'desc' => [Autor::tableName() . '.name' => SORT_DESC],
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
            'autor_id' => $this->autor_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'edition', $this->edition])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', Autor::tableName() . '.name', $this->autorName]);

        return $dataProvider;
    }
}
