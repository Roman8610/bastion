<?php

namespace app\components;


class MenuWidget extends \yii\base\Widget
{
    public function init() 
    {
        parent::init();
    }
    
    public function run() {
        
       $categories = \app\models\Category::find()->where(['parent_id' => 0])->orderBy('priority DESC')->all();
             
       return $this->render('menu', compact('categories'));       
    }
}