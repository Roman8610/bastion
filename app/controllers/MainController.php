<?php

namespace app\controllers;

class MainController extends AppController
{
    public function actionIndex()
    {

        $this->view->title = "Интернет-магазин «Bastion»";
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "Огромный ассортимент ЭКБ от «Bastion». ✅ Продажа оптом и в розницу. Доставка по всей РФ. 📞 Звоните +79991112233"]); 
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Каталог']);

        return $this->render('index');
    }
}