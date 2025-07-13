<?php


namespace app\controllers;


class MessageController extends AppController{
    
   // public $layout = 'height_message';


    public function actionIndex(){
		
		$description = "Заказ успешно создан";
        
        $this->view->title ='Заказ успешно создан';
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => '']); 
		
		$this->view->params['ogDescription'] = $description;
        
        return $this->render('index');
        
    }
    
}