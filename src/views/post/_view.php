<?php

use yii\helpers\Html;

/**
 * @var $this \yii\web\View
 * @var $model \nullref\blog\models\Post
 * @var $key mixed
 * @var $index integer
 * @var $widget \yii\widgets\ListView
 */
?>
<div class="blog-item">
    <h2><?= Html::a($model->title, ['post/view' ,'slug'=> $model->slug]) ?></h2>

    <p><?= $model->short_text ?></p>
</div>
