<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class OrderController extends AppController{
    
    public function actionSend(){

        //var_dump($_POST["g-recaptcha-response"]); die;
        
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
            $orderModel = new \app\models\Orders();

            $orderModel->setScenario('OrderScenario');

            $name = $_POST['Orders']['name'];
            // $last_name = $_POST['Orders']['last_name'];
            $phone = $_POST['Orders']['phone'];
            $email = $_POST['Orders']['email'];
            $message = $_POST['Orders']['message'];
            $prod_id = $_POST['Orders']['prod_id'];
            

            
            
            if($orderModel->load(\Yii::$app->request->post()) && $orderModel->validate()){  
                
                $orderModel->file = UploadedFile::getInstance($orderModel, 'file');
                
                
                if($orderModel->file instanceof UploadedFile)
                {
                        $path = $this->uniqFileName($orderModel->file);
                    // var_dump($path); die;
                        if($orderModel->file->saveAs($path))
                        {
                            $orderModel->file_path = $path;
                        }
                }

                if($orderModel->save())
                {

                    $prod = Product::find()->where(['id' => $prod_id])->one();

                    $link = '';

                    if($prod)
                    {
                        $link = Url::to(['product/index', 'alias' => $prod->alias]);
                    }

                    Yii::$app->mailer->compose()
                    ->setFrom('zakazbastionit@yandex.ru')
                    ->setTo(['roman8610@gmail.com', 'info@bastionit.ru']) // , 'info@bastionit.ru'
                    ->setSubject('Заказ товара')
                    ->setHtmlBody('<b>Имя: </b>'.$name.'<br><b>Телефон: </b>'.$phone.'<br><b>Email: </b>'.$email.'<br><b>Комментарий: </b>'.$message.'<br>'.'<br><b>Ссылка на товар: </b><a href="https://bastionit.ru'.$link.'">https://bastionit.ru/'.$link.'<br>')
                    ->send();

                    return \Yii::$app->response->redirect(['message/index']);
                }

        }
                

            
        }
        

    }   

    public function uniqFileName($file, $i=0)
    {
        $name = $i == 0 ? $file->baseName : $file->baseName . '-' . $i;
        $path = 'docs_order/' . $name . '.' . $file->extension;
        if(file_exists($path))
        {
            $i++;
            $path = $this->uniqFileName($file, $i);
        }
       
        return $path;
    }

}