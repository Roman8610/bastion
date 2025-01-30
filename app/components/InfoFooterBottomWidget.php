<?php

namespace app\components;

use app\models\Pages;

class InfoFooterBottomWidget extends \yii\base\Widget
{

   // public $priority_news = 0;

    public function init() 
    {
        parent::init();
    }
    
    public function run() {
        
       $pages = Pages::find()->where(['status' => '1', 'parent_id' => '0', 'show_footer_1' => '1'])->orderBy('priority DESC')->all();


             
       return $this->render('info-menu-footer-bottom', [
            'pages' => $pages,
       ]);       
    }
}