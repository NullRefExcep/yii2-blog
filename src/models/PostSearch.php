<?php

namespace nullref\blog\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * PostSearch represents the model behind the search form about `app\modules\blog\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'short_text', 'text', 'slug', 'data'], 'safe'],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        if (isset($behaviors['slug'])) {
            unset($behaviors['slug']);
        }
        if (isset($behaviors['timestamp'])) {
            unset($behaviors['timestamp']);
        }
        return $behaviors;
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'short_text', $this->short_text])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }

    /**
     * @param $slug
     * @return array|null|Post
     * @throws NotFoundHttpException
     */
    public function findBySlug($slug)
    {
        /** @var PostQuery $query */
        $query = Post::find();

        $query->published()->bySlug($slug);

        if (($model = $query->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
