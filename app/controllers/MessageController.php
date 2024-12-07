<?php


namespace app\controllers;


class MessageController extends AppController{
    
   // public $layout = 'height_message';


    public function actionIndex(){
        
        $this->view->title ='Заказ успешно создан';
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Заказ успешно создан']);
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => '']); 
        
        return $this->render('index');
        
    }
    
}