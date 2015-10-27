<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\BlogPost */

$this->title = Yii::t('app', 'Create Blog Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
