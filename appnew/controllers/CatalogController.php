<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Exception;
use yii\data\Pagination;
use Yii;

class CatalogController extends AppController
{
    public function actionIndex($alias)
    {
        $categry_current = Category::find()->where(['alias'=>$alias])->one();
        if (!$categry_current) {
            throw new \yii\web\NotFoundHttpException('Категория не найдена');
        }

        $child_categories = Category::find()->where(['parent_id' => $categry_current->id_import])->all();
        
        $page = Yii::$app->request->get('page', 1);
        
        if($page == 1) {
            $description = "$categry_current->title. Огромный ассортимент ЭКБ от «Bastion». ✅ Продажа мелким и крупным оптом. Доставка по всей РФ. 📞 Звоните +7 (812) 920-85-20";
			$this->view->title = "$categry_current->title - купить мелким и крупным оптом в «Bastion» | Быстрая доставка в СПб и по всей РФ";
        } else {
            $description = $categry_current->title . ". Страница " . $page . ". 📞 Звоните +79991112233";
			$this->view->title = $categry_current->title . ". Страница " . $page . " - «Bastion»";
        }
		
        
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => ""]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
        
        $this->view->params['ogDescription'] = $description;

        if($child_categories)
        {
            $cat_ids = [];
            foreach($child_categories as $child_category)
            {
                $cat_ids[] = $child_category->id_import;
            }

            $query = Product::find()->where(['category_id' => $cat_ids]);
        }
        else
        {
            $query = Product::find()->where(['category_id' => $categry_current->id_import]);
        }

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 24,
            'page' => $page - 1, // Pagination в Yii2 использует 0-based нумерацию
        ]);
        
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', compact('child_categories', 'categry_current', 'products', 'pages'));
    }
}