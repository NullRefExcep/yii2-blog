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

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'blog';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        '<slug:[A-Za-z0-9_-]+>' => 'blog/view',
    ];

    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('blog', 'Blog'),
            'url' => ['/blog/admin'],
            'icon' => 'archive',
        ];
    }
} 