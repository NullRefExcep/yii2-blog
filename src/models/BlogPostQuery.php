<?php

namespace nullref\blog\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[BlogPost]].
 *
 * @see BlogPost
 */
class BlogPostQuery extends ActiveQuery
{
    public function published()
    {
        $this->andWhere('status=:status', [':status' => BlogPost::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return BlogPost[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BlogPost|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}