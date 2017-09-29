<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * BookSearch represents the model behind the search form of `common\models\Book`.
 */
class BookSearch extends Book
{
    public $name_dv;
    public $s_start_time;
    public $s_created_at;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'old', 'id_dv', 'time_start', 'created_at', 'updated_at','status'], 'integer'],
            [['full_name', 'phone', 'email','name_dv','s_created_at','s_start_time'], 'safe'],
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
        $query = Book::find();

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
            'old' => $this->old,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        if($this->name_dv){
            $query->innerJoin('news','news.id = book.id_dv')
            ->andWhere(['like','news.title',$this->name_dv]);
        }

        if($this->s_start_time){
            $query->andFilterWhere(['>=', 'book.time_start', strtotime($this->s_start_time)]);
            $query->andFilterWhere(['<=', 'book.time_start', strtotime($this->s_start_time) + 86400]);
        }

        if($this->s_created_at){
            $query->andFilterWhere(['>=', 'book.created_at', strtotime($this->s_created_at)]);
            $query->andFilterWhere(['<=', 'book.created_at', strtotime($this->s_created_at) + 86400]);
        }

        return $dataProvider;
    }
}
