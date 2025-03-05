<?php

namespace app\components;

use yii\web\NotFoundHttpException;


class ImportViewWidget extends \yii\base\Widget
{

    public $model;

    public function init() 
    {
        parent::init();
    }
    
    public function run() {

        $filePath = 'import.json';

        $jsonString = file_get_contents($filePath);

        if($jsonString)
        {
            $data = json_decode($jsonString, true);
        }
        else
        {
            throw new NotFoundHttpException();
        }

        if($data['status'] == 'stopped')
        {
            return $this->render('import-form', [
                'model' => $this->model,
            ]);    
        }

        if($data['status'] == 'run')
        {
            return $this->render('import-run', [
                'data' => $data,
           ]);    
        }
       

    }

}