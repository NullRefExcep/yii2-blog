<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var $this \yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = Yii::t('blog', 'Blog');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
    ]) ?>
</div>
