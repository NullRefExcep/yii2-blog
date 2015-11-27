<?php

namespace nullref\blog;

use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;
use yii\web\Application as WebApplication;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app instanceof WebApplication) {
            if (!isset($app->i18n->translations['blog*'])){
                $app->i18n->translations['blog*']=[
                    'class' => PhpMessageSource::className(),
                    'basePath' => '@nullref/blog/messages',
                ];
            }
        }
    }
}
