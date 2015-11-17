<?php

namespace nullref\blog\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Post]].
 *
 * @see Post
 */
class PostQuery extends ActiveQuery
{
    public function published()
    {
        $this->andWhere('status=:status', [':status' => Post::STATUS_PUBLISHED]);
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