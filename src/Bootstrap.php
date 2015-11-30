<?php

namespace nullref\blog;

use nullref\blog\components\BlogStatusList;
use nullref\blog\models\Post;
use Yii;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;
use yii\web\Application as WebApplication;

class Bootstrap implements BootstrapInterface
{
    protected $classMap = [
        'Post' => 'nullref\blog\models\Post',
        'BlogStatusList' => 'nullref\blog\components\BlogStatusList',
    ];

    public function bootstrap($app)
    {
        /** @var Module $module */
        if ($app->hasModule('blog') && ($module = $app->getModule('blog')) instanceof Module) {
            $classMap = array_merge($this->classMap, $module->classMap);
            Yii::$container->setSingleton(BlogStatusList::className(), $classMap['BlogStatusList']);
            $postClass = Post::className();
            $definition = $classMap['Post'];
            Yii::$container->set($postClass, $definition);
        }
        if ($app instanceof WebApplication) {
            if (!isset($app->i18n->translations['blog*'])) {
                $app->i18n->translations['blog*'] = [
                    'class' => PhpMessageSource::className(),
                    'basePath' => '@nullref/blog/messages',
                ];
            }
        }
    }
}
