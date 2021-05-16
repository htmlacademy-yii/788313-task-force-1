<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\File;

/**
 * FileSearch represents the model behind the search form of `app\models\File`.
 */
class FileSearch extends File
{
    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['id', 'users_id'], 'integer'],
            [['file_1', 'file_2', 'file_3', 'file_4', 'file_5', 'file_6'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios():array
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
    public function search($params):object
    {
        $query = File::find();

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
        ]);

        $query->andFilterWhere(['like', 'file_1', $this->file_1])
            ->andFilterWhere(['like', 'file_2', $this->file_2])
            ->andFilterWhere(['like', 'file_3', $this->file_3])
            ->andFilterWhere(['like', 'file_4', $this->file_4])
            ->andFilterWhere(['like', 'file_5', $this->file_5])
            ->andFilterWhere(['like', 'file_6', $this->file_6]);

        return $dataProvider;
    }
}
