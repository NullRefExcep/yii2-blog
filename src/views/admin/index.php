<?php

use nullref\blog\models\Post;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $selectId integer */
/* @var $searchModel \nullref\blog\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Blog Posts');
$this->params['breadcrumbs'][] = $this->title;

if ($selectId) {
    $this->registerJs("jQuery('[data-key=$selectId]').addClass('success')");
}
?>
<div class="blog-post-index">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('blog', 'Create Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            'title',
            'slug',
            [
                'filter' => Post::getStatuses(),
                'attribute' => 'status',
                'value' => 'statusTitle',
            ],
            'created_at:datetime',
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{duplicate} {view} {update} {delete}',
                'buttons' => [
                    'duplicate' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('blog', 'Duplicate'),
                            'aria-label' => Yii::t('blog', 'Duplicate'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-duplicate"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
