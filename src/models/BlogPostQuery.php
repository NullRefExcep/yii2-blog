<?php

namespace nullref\blog\models;
use nullref\blog\models\BlogPost;

/**
 * This is the ActiveQuery class for [[BlogPost]].
 *
 * @see BlogPost
 */
class BlogPostQuery extends \yii\db\ActiveQuery
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