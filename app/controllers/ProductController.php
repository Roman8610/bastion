<?php

namespace app\controllers;

use app\models\AttrProd;
use app\models\AttrValue;
use app\models\Category;
use app\models\Product;
use Exception;
use yii\data\Pagination;

class ProductController extends AppController
{
    public function actionIndex($alias)
    {
        $product = Product::find()->where(['alias' => $alias])->one();

        $this->view->title = "$product->title | Купить в интернет-магазине «Bastion» | Быстрая доставка в СПб";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'Ключевые слова страницы']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$product->title 📦 Поставка электронной компонентной базы (ЭКБ). Гарантируем контроль качества. ✅ Доставка по все России. 📞 Звоните 8 (812) 920 8520"]);

        $params = AttrProd::find()->where(['product_id' => $product->id])->all();

        $category = Category::find()->where(['id_import'=>$product->category_id])->one();

        $similar_products = Product::find()->where(['category_id' => $product->category_id])->limit(8)->all();

        return $this->render('index', compact('product', 'similar_products', 'category', 'params'));
    }
}