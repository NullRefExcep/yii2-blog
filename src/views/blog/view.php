<?php

/** @var $this \yii\web\View */
/** @var $model \nullref\blog\models\Post */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog'), 'url' => '/blog'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">
    <h1><?= $this->title ?></h1>

    <p><?= $model->text ?></p>
</div>
