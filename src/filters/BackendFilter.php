<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 */

namespace nullref\blog\filters;


use yii\base\ActionFilter;
use yii\web\NotFoundHttpException;

/**
 * BackendFilter is used to restrict access to admin controller in backend when using in advanced template.
 *
 */
class BackendFilter extends ActionFilter
{
    /**
     * @var array
     */
    public $controllers = ['admin'];

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     * @throws \yii\web\NotFoundHttpException
     */
    public function beforeAction($action)
    {
        if (!in_array($action->controller->id, $this->controllers)) {
            throw new NotFoundHttpException('Not found');
        }

        return true;
    }
}
