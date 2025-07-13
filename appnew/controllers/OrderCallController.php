<?php

namespace app\controllers;

use app\models\OrdersCall;
use Yii;
use yii\web\Response;

class OrderCallController extends AppController{
    
    public function actionSend(){

        // var_dump($_POST); die;

            // Параметры запроса
        $secret = '6LehPsMqAAAAANk3gwCSw52nd0rG94tSi3GcUwUN';      // Ваш секретный ключ
        $response = $_POST["g-recaptcha-response"];      // Токен от клиента
        $remoteIp = $_SERVER['REMOTE_ADDR']; // IP адрес пользователя

        // Создаем массив данных для отправки
        $data = array(
            'secret' => $secret,
            'response' => $response,
            'remoteip' => $remoteIp
        );

        // Преобразуем данные в строку формата x-www-form-urlencoded
        $fields_string = http_build_query($data);

        // Определяем заголовки
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded'
        );

        // Выполняем запрос
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, true);          // Использовать POST-метод
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Устанавливаем заголовки
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); // Данные для отправки
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Возвращать результат как строка

        $result = curl_exec($ch);
        curl_close($ch);

        // Парсим ответ JSON
        $verificationResponse = json_decode($result, true);

       // var_dump($verificationResponse); die;

        if ($verificationResponse['success'] && $verificationResponse['score'] > 0.7) {
            
            $orderModel = new OrdersCall();

            $orderModel->setScenario('OrderCallScenario');
    
            $name = $_POST['OrdersCall']['name'];
            $phone = $_POST['OrdersCall']['phone'];
    
            if($orderModel->load(\Yii::$app->request->post()) && $orderModel->validate() && $orderModel->save()){  
                
                Yii::$app->mailer->compose()
                ->setFrom('zakazbastionit@yandex.ru')
                ->setTo(['roman8610@gmail.com', 'info@bastionit.ru', 'mi@bastion24.ru']) // 'info@bastionit.ru'
                ->setSubject('Обратный звонок')
                ->setHtmlBody('<b>Имя: </b>'.$name.'<br><b>Телефон: </b>'.$phone)
                ->send();
    
    
                return \Yii::$app->response->redirect(['message/index']);
            }else{
              
            }

        } else {
            echo "Ошибка проверки.";
        }

        die;
 

        

    }   

    public function actionRecaptcha()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
        
    }
}