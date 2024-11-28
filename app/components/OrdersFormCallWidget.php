<?php

namespace app\components;


class OrdersFormCallWidget extends \yii\base\Widget{
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        parent::run();
        
        $order = new \app\models\OrdersCall();
 
        return $this->render('form-call', compact('order'));
        
    }
    
}