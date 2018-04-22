<?php

namespace nullref\blog\components;

use nullref\core\interfaces\IStatusList;
use Yii;
use yii\base\BaseObject;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 */
class BlogStatusList extends BaseObject implements IStatusList
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    public function getList()
    {
        return [
            self::STATUS_DRAFT => Yii::t('blog', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('blog', 'Published')
        ];
    }
}