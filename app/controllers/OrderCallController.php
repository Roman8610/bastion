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
            
        //     Yii::$app->mailer->compose()
        //     ->setFrom('bastionit@rambler.ru')
        //     ->setTo('cxae@ya.ru')
        //     ->setSubject('Обратный звонок')
        //  //   ->setTextBody('Обратный звонок'.$name.':'.$phone)
        //     ->setHtmlBody('<b>ФИО: </b>'.$name.'<br><b>Телефон: </b>'.$phone)
        //     ->send();

        $admin_email = "drom24@inbox.ru";
        $form_subject = "Заявка с сайта bastionit.ru";
        $project_name = "info@bastionit.ru";
        
        // Предполагаем, что $name и $phone уже определены
        $html = '
            <h1>Заявка с сайта bastionit.ru</h1>
            <p><b>ФИО: </b>' . htmlspecialchars($name) . '</p>
            <p><b>Телефон: </b>' . htmlspecialchars($phone) . '</p>';
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
        $headers .= "From: " . $project_name . "\r\n";
        $headers .= "Reply-To: " . $project_name . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        mail($admin_email, $form_subject, $html, $headers);


            return \Yii::$app->response->redirect(['message/index']);
        }else{
          
        }
        

    }   
}