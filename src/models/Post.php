<?php

namespace nullref\blog\models;

use nullref\blog\components\BlogStatusList;
use nullref\useful\SerializeBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;
use yii\web\View;

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
 * @property $meta array
 * @property $picture string
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
            [['meta', 'picture'], 'safe'],
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
            'serialize' => [
                'class' => SerializeBehavior::className(),
                'fields' => ['meta'],
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
        ]);
    }

    /**
     * @return object
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        $definition = Yii::$container->getDefinitions()[__CLASS__];
        return Yii::createObject(PostQuery::className(), [$definition['class']]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'ID'),
            'title' => Yii::t('blog', 'Title'),
            'short_text' => Yii::t('blog', 'Short Text'),
            'text' => Yii::t('blog', 'Text'),
            'slug' => Yii::t('blog', 'Slug'),
            'status' => Yii::t('blog', 'Status'),
            'created_at' => Yii::t('blog', 'Created At'),
            'updated_at' => Yii::t('blog', 'Updated At'),
            'data' => Yii::t('blog', 'Data'),
            'meta' => Yii::t('blog', 'Meta'),
            'picture' => Yii::t('blog', 'Picture'),
        ];
    }

    /**
     * @param int $length
     * @param string $allowableTags
     * @return string
     */
    public function getTextTeaser($length = 400, $allowableTags = '<b></b><i></i><br>')
    {
        $withoutTags = strip_tags($this->text, $allowableTags);
        return StringHelper::truncate($withoutTags, $length);
    }

    /**
     * @param View $view
     */
    public function registerMetaTags($view)
    {
        if (!empty($this->meta)) {
            foreach ($this->meta as $metaTag) {
                $view->registerMetaTag($metaTag, $metaTag['name']);
            }
        }
    }
}
