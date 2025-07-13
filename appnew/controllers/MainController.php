<?php

namespace app\controllers;

use Exception;
use Yii;

class MainController extends AppController
{
    public function actionIndex()
    {

        // $redis = Yii::$app->cache;
        // $redis->set('тест_ключ', 'значение_тест');


		// die;


		$description = 'Огромный ассортимент ЭКБ от «Bastion». ✅ Продажа крупным и мелким оптом. Доставка по всей РФ. 📞 Звоните +7 (812) 920-85-20';

        $this->view->title = "«Bastion» - поставка электронной компонентной базы (ЭКБ) по всей России";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => ""]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
		$this->view->params['ogDescription'] = $description;

        return $this->render('index');
    }
}