<?php

namespace app\controllers;

use Yii;

class OrderController extends AppController{
    
    public function actionSend(){
 
        $orderModel = new \app\models\Orders();

        $name = $_POST['Orders']['name'];
        $last_name = $_POST['Orders']['last_name'];
        $phone = $_POST['Orders']['phone'];
        $email = $_POST['Orders']['email'];
        $message = $_POST['Orders']['message'];
        
        if($orderModel->load(\Yii::$app->request->post()) && $orderModel->validate() && $orderModel->save()){   
                
            Yii::$app->mailer->compose()
            ->setFrom('bastionit@rambler.ru')
            ->setTo('cxae@ya.ru')
            ->setSubject('Заказ товара')
            ->setHtmlBody('<b>Имя: </b>'.$name.'<br><b>Фамилия: </b>'.$last_name.'<br><b>Телефон: </b>'.$phone.'<br><b>Email: </b>'.$email.'<br><b>Комментарий: </b>'.$message)
            ->send();

            return \Yii::$app->response->redirect(['message/index']);
        }
        

    }   
}