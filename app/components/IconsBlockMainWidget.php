<?php

namespace app\components;

use app\models\Pages;

class IconsBlockMainWidget extends \yii\base\Widget
{

    public function init() 
    {
        parent::init();
    }
    
    public function run() {
        
       $pages = Pages::find()->where(['status' => '1', 'show_icons_block' => '1'])->orderBy('priority DESC')->all();


             
       return $this->render('icons-block-main', [
            'pages' => $pages,
       ]);       
    }
}