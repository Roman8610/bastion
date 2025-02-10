<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class OrderController extends AppController{
    
    public function actionSend(){
 
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

                if($prod)
                {
                    $link = Url::to(['product/index', 'alias' => $prod->alias]);
                }

                Yii::$app->mailer->compose()
                ->setFrom('zakazbastionit@yandex.ru')
                ->setTo(['roman8610@gmail.com', 'info@bastionit.ru'])
                ->setSubject('Заказ товара')
                ->setHtmlBody('<b>Имя: </b>'.$name.'<br><b>Телефон: </b>'.$phone.'<br><b>Email: </b>'.$email.'<br><b>Комментарий: </b>'.$message.'<br>'.'<br><b>Ссылка на товар: </b><a href="https://bastionit.ru'.$link.'">https://bastionit.ru/'.$link.'<br>')
                ->send();

                return \Yii::$app->response->redirect(['message/index']);
            }

           
                
            // Yii::$app->mailer->compose()
            // ->setFrom('zakazbastionit@yandex.ru')
            // ->setTo('roman8610@gmail.com')
            // ->setSubject('Заказ товара')
            // ->setHtmlBody('<b>Имя: </b>'.$name.'<br><b>Телефон: </b>'.$phone.'<br><b>Email: </b>'.$email.'<br><b>Комментарий: </b>'.$message)
            // ->send();

            
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