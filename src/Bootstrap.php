<?php

namespace nullref\blog;

use nullref\blog\components\BlogStatusList;
use Yii;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;
use yii\web\Application as WebApplication;
use yii\web\GroupUrlRule;

class Bootstrap implements BootstrapInterface
{
    protected $classMap = [
        'Post' => 'nullref\blog\models\Post',
        'PostSearch' => 'nullref\blog\models\PostSearch',
        'PostQuery' => 'nullref\blog\models\PostQuery',
        'BlogStatusList' => 'nullref\blog\components\BlogStatusList',
    ];

    public function bootstrap($app)
    {
        /** @var Module $module */
        if ($app->hasModule('blog') && ($module = $app->getModule('blog')) instanceof Module) {
            $classMap = array_merge($this->classMap, $module->classMap);
            Yii::$container->setSingleton(BlogStatusList::className(), $classMap['BlogStatusList']);
            foreach (['PostSearch', 'PostQuery', 'Post'] as $item) {
                $className = '\nullref\blog\models\\' . $item;
                $postClass = $className::className();
                $definition = $classMap[$item];
                Yii::$container->set($postClass, $definition);
            }
        }
        if ($app instanceof WebApplication) {
            if (!isset($app->i18n->translations['blog*'])) {
                $app->i18n->translations['blog*'] = [
                    'class' => PhpMessageSource::className(),
                    'basePath' => '@nullref/blog/messages',
                ];
            }

            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules' => $module->urlRules,
            ];

            $app->urlManager->addRules([new GroupUrlRule($configUrlRule)], false);
        }
    }
}
