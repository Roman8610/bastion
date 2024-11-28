<?php

namespace app\components;


class MenuFooterWidget extends \yii\base\Widget
{
    public function init() 
    {
        parent::init();
    }
    
    public function run() {
        
       $categories = \app\models\Category::find()->where(['parent_id' => 0])->orderBy('priority DESC')->limit(7)->all();
             
       return $this->render('menu-footer', compact('categories'));       
    }
}