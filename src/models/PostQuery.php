<?php

namespace nullref\blog\models;

use nullref\blog\components\BlogStatusList;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Post]].
 *
 * @see Post
 */
class PostQuery extends ActiveQuery
{
    /**
     * Select only published posts
     * @return $this
     */
    public function published()
    {
        $this->andWhere('status=:status', [':status' => BlogStatusList::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     * Select post by slug
     * @param $slug
     * @return $this
     */
    public function bySlug($slug)
    {
        $this->andFilterWhere(['slug' => $slug]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}