<?php

namespace nullref\blog\controllers;

use nullref\blog\models\PostSearch;
use Yii;
use yii\web\Controller;

class BlogController extends Controller
{
    public $singleView = 'view';
    public $listView = 'index';

    public function actionView($slug)
    {
        /** @var PostSearch $searchModel */
        $searchModel = Yii::createObject(PostSearch::className());
        $dataProvider = $searchModel->findBySlug($slug);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        /** @var PostSearch $searchModel */
        $searchModel = Yii::createObject(PostSearch::className());
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
