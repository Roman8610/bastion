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

        $this->view->title = $page->title_seo;
       // $this->view->registerMetaTag(['name' => 'keywords', 'content' => "Огромный ассортимент ЭКБ от «Bastion». ✅ Продажа оптом и в розницу. Доставка по всей РФ. 📞 Звоните +79991112233"]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => $page->description_seo]);
		
		$this->view->params['ogDescription'] = $page->description_seo;

        return $this->render('view', compact('page'));
    }

}