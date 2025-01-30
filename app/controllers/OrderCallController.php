<?php

namespace app\controllers;

use app\models\OrdersCall;
use Yii;

class OrderCallController extends AppController{
    
    public function actionSend(){
 
        $orderModel = new OrdersCall();

        $orderModel->setScenario('OrderCallScenario');

        $name = $_POST['OrdersCall']['name'];
        $phone = $_POST['OrdersCall']['phone'];

        if($orderModel->load(\Yii::$app->request->post()) && $orderModel->validate() && $orderModel->save()){  
            
            Yii::$app->mailer->compose()
            ->setFrom('zakazbastionit@yandex.ru')
            ->setTo(['roman8610@gmail.com', 'info@bastionit.ru'])
            ->setSubject('Обратный звонок')
            ->setHtmlBody('<b>Имя: </b>'.$name.'<br><b>Телефон: </b>'.$phone)
            ->send();


            return \Yii::$app->response->redirect(['message/index']);
        }else{
          
        }
        

    }   
}