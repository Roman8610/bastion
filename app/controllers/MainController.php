<?php

namespace app\controllers;

class MainController extends AppController
{
    public function actionIndex()
    {
		
		$description = 'Огромный ассортимент ЭКБ от «Bastion». ✅ Продажа оптом и в розницу. Доставка по всей РФ. 📞 Звоните +79991112233';

        $this->view->title = "«Bastion» - поставка электронной компонентной базы (ЭКБ) по всей России";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => ""]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
		$this->view->params['ogDescription'] = $description;

        return $this->render('index');
    }
}