<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \nullref\blog\models\Post */

$this->title = Yii::t('blog', 'Update Blog Post:') . ' "' . $model->title. '"';
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'Update');
?>
<div class="blog-post-update">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
