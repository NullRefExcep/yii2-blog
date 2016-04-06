Blog module for Yii2
====================
[![Latest Stable Version](https://poser.pugx.org/nullref/yii2-blog/v/stable)](https://packagist.org/packages/nullref/yii2-blog) [![Total Downloads](https://poser.pugx.org/nullref/yii2-blog/downloads)](https://packagist.org/packages/nullref/yii2-blog) [![Latest Unstable Version](https://poser.pugx.org/nullref/yii2-blog/v/unstable)](https://packagist.org/packages/nullref/yii2-blog) [![License](https://poser.pugx.org/nullref/yii2-blog/license)](https://packagist.org/packages/nullref/yii2-blog)


## Installation

The preferred way to install this extension to use [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nullref/yii2-blog "*"
```

or add

```
"nullref/yii2-blog": "*"
```

to the require section of your `composer.json` file.


##Override classes

You can override classes by module config.

```php
'blog' => [
    'class' => "nullref\\blog\\Module",  
    'classMap'=>[
        'Post' => 'app\models\Post',
        'PostSearch' => 'nullref\app\PostSearch',
        'PostQuery' => 'app\models\PostQuery',
        'BlogStatusList' => 'app\components\BlogStatusList',
    ],
],
```

## Add custom statuses

When you override `BlogStatusList` class, you can add custom statuses for blog posts.
Example:

```php

namespace app\components;


class BlogStatusList extends \nullref\blog\components\BlogStatusList
{
    const STATUS_HIDE = 3;

    public function getList()
    {
        return array_merge(parent::getList(),[
            self::STATUS_HIDE => \Yii::t('app','Hide'),
        ]);
    }
}
```
