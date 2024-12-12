<?php

namespace app\controllers;

use app\models\News;

class NewsController extends AppController
{
    public function actionIndex()
    {

        $this->view->title = "Новости и публикации";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "Новости и публикации"]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Новости и публикации']);

        $news = News::find()->all();

        return $this->render('index', compact('news'));
    }

    public function actionView($id)
    {
        $this->view->title = "Новости и публикации";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "Новости и публикации"]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Новости и публикации']);

        $new = News::find()->where(['id' => $id])->one();

        return $this->render('view', compact('new'));
    }
}