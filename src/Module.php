<?php

namespace nullref\blog;

use nullref\core\components\Module as BaseModule;
use nullref\core\interfaces\IAdminModule;
use Yii;

/**
 * Class Module
 * @package nullref\blog
 */
class Module extends BaseModule implements IAdminModule
{
    public $postModel = 'nullref\blog\models\Post';

    public $classMap = [];

    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('blog', 'Blog'),
            'url' => ['/blog/admin'],
            'icon' => 'archive',
        ];
    }
} 