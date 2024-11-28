<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Exception;
use yii\data\Pagination;

class CatalogController extends AppController
{
    public function actionIndex($alias)
    {
        $categry_current = Category::find()->where(['alias'=>$alias])->one();

        $child_categories = Category::find()->where(['parent_id' => $categry_current->id_import])->all();

        $this->view->title = "$categry_current->title - купить в интернет-магазине «Bastion» | Быстрая доставка в СПб";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$categry_current->title. Огромный ассортимент ЭКБ от «Bastion». ✅ Продажа оптом и в розницу. Доставка по всей РФ. 📞 Звоните +79991112233"]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Каталог']);

        if($child_categories)
        {
            
            $cat_ids = [];

            foreach($child_categories as $child_category)
            {
                $cat_ids[] = $child_category->id_import;
            }

        //    $product = Product::find()->where(['category_id' => $cat_ids])->all();

            $query = Product::find()->where(['category_id' => $cat_ids]);
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 24]);
            
            $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        }
        else
        {
        //    $product = Product::find()->where(['category_id' => $id_import])->all();

            $query = Product::find()->where(['category_id' => $categry_current->id_import]);
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 24]);
            
            $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        }
        return $this->render('index', compact('child_categories', 'categry_current', 'products', 'pages'));
    }
}