<?php

namespace app\components;


class OrdersFormWidget extends \yii\base\Widget{
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        parent::run();
        
        $order = new \app\models\Orders();
 
        return $this->render('form', compact('order'));
        
    }
    
}