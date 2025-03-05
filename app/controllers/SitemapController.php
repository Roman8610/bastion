<?

namespace app\controllers;

use app\models\Category;
use app\models\Pages;

class SitemapController extends AppController
{
    public function actionIndex()
    {
		
		$description = "Карта сайта";

        $this->view->title = "Карта сайта";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => ""]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
		
		$this->view->params['ogDescription'] = $description;
		
        $categories = Category::find()->all();
        $pages = Pages::find()->all();

        return $this->render('index', [
            'categories' => $categories,
            'pages' => $pages,
        ]);
    }
}