<?php

namespace app\components;

use app\models\Pages;

class InfoMenuHeadWidget extends \yii\base\Widget
{

    public $priority_news = 0;

    public function init() 
    {
        parent::init();
    }
    
    public function run() {
        
       $pages = Pages::find()->where(['status' => '1', 'parent_id' => '0', 'show_main' => '1'])->orderBy('priority DESC')->all();

    //    echo '<pre>';
    //    print_r($pages);
    //    echo '</pre>';

    //    die;
             
       return $this->render('info-menu-head', [
            'pages' => $pages,
            'priority_news' => $this->priority_news,
       ]);       
    }
}