<?php

namespace nullref\blog\models;

use nullref\blog\components\BlogStatusList;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $short_text
 * @property string $slug
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $data
 */
class Post extends ActiveRecord
{
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
            [['title', 'text', 'status', 'short_text'], 'required'],
            [['text', 'data', 'short_text'], 'string'],
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
        return Yii::$container->get(BlogStatusList::className())->getList();
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getStatusTitle()
    {
        $list = Yii::$container->get(BlogStatusList::className())->getList();
        return isset($list[$this->status]) ? $list[$this->status] : Yii::t('blog', 'N/A');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => 'updated_at',
                'createdAtAttribute' => 'created_at'
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
        ]);
    }

    public static function find()
    {
        return Yii::createObject(PostQuery::className(), [get_called_class()]);
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
            'created_at' => Yii::t('blog', 'Created At'),
            'updated_at' => Yii::t('blog', 'Updated At'),
            'data' => Yii::t('blog', 'Data'),
        ];
    }
}
