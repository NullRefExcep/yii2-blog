<?php

namespace nullref\blog\models;

use yii\behaviors\TimestampBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $slug
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property string $data
 */
class BlogPost extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DELETED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'status'], 'required'],
            [['text', 'data'], 'string'],
            [['status'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * Returns post statuses map
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => Yii::t('blog', 'Draft'),
            self::STATUS_DELETED => Yii::t('blog', 'Deleted'),
            self::STATUS_PUBLISHED => Yii::t('blog', 'Published')
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => 'updatedAt',
                'createdAtAttribute' => 'createdAt'
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'ID'),
            'title' => Yii::t('blog', 'Title'),
            'text' => Yii::t('blog', 'Text'),
            'slug' => Yii::t('blog', 'Slug'),
            'status' => Yii::t('blog', 'Status'),
            'createdAt' => Yii::t('blog', 'Created At'),
            'updatedAt' => Yii::t('blog', 'Updated At'),
            'data' => Yii::t('blog', 'Data'),
        ];
    }
}
