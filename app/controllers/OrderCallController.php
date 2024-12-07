<?php

namespace app\controllers;

use app\models\OrdersCall;
use Yii;

class OrderCallController extends AppController{
    
    public function actionSend(){
 
        $orderModel = new OrdersCall();

        $name = $_POST['OrdersCall']['name'];
        $phone = $_POST['OrdersCall']['phone'];

        if($orderModel->load(\Yii::$app->request->post()) && $orderModel->validate() && $orderModel->save()){  
            
            Yii::$app->mailer->compose()
            ->setFrom('zakazbastionit@yandex.ru')
            ->setTo('drom24@inbox.ru')
            ->setSubject('Обратный звонок')
            ->setHtmlBody('<b>ФИО: </b>'.$name.'<br><b>Телефон: </b>'.$phone)
            ->send();


            return \Yii::$app->response->redirect(['message/index']);
        }else{
          
        }
        

    }   
}