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
		
		$description = "$product->title 📦 Поставка электронной компонентной базы (ЭКБ). Гарантируем контроль качества. ✅ Доставка по все России. 📞 Звоните 8 (812) 920 8520";

        $this->view->title = "$product->title | Купить мелким и крупным ортом | Быстрая доставка в СПб и по всей РФ";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => '']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
		
		$this->view->params['ogDescription'] = $description;

        $params = AttrProd::find()->where(['product_id' => $product->id])->all();

        $category = Category::find()->where(['id_import'=>$product->category_id])->one();

        $similar_products = Product::find()->where(['category_id' => $product->category_id])->limit(8)->all();

        return $this->render('index', compact('product', 'similar_products', 'category', 'params'));
    }
}