<?php

namespace app\controllers;

use app\models\Product;
use yii\data\Pagination;

class SearchController extends AppController
{
    public function actionIndex($q)
    {
       
       // $products = Product::find()->where(['like', 'title', $q])->all();

        $query = Product::find()->where(['like', 'title', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 24]);
        
        $products = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('index', compact('products', 'pages', 'q'));
    }
}