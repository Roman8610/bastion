<?php

namespace app\controllers;

use app\models\Category;
use app\models\Pages;
use app\models\Product;
use Exception;
use yii\data\Pagination;

class PagesController extends AppController
{

    public $layout = 'bastion_info';

    public function actionView($alias)
    {
        $page = Pages::find()->where(['alias' => $alias])->one();

        return $this->render('view', compact('page'));
    }

}