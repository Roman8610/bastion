<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Import;
use app\modules\admin\models\ImportStatistics;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ImportController extends AppAdminController
{

    public function actionIndex()
    {
        $model = new Import();

        if($this->request->isPost)
        {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {
                $path = 'importfiles/' . $model->file->baseName . '.' . $model->file->extension;
                if($model->file->saveAs($path))
                {
                    $projectPath = Yii::getAlias('@app');
                    shell_exec("php $projectPath/yii import-gui > /dev/null 2>&1 &");
                    return $this->refresh();
                }
            }
        } 

        $imports = ImportStatistics::find()->all();

        return $this->render('index',[
            'model' => $model,
            'imports' => $imports,
        ]);

    }

    public function actionProcess()
    {
        if (Yii::$app->request->isAjax) {

            $filePath = 'import.json';

            $jsonString = file_get_contents($filePath);
    
            if($jsonString)
            {
                $data = json_decode($jsonString, true);
            }
    
            if($data['status'] == 'stopped')
            {
                $model = new Import();
                return $this->renderAjax('import-form-ajax', [
                    'model' => $model,
                ]);    
            }
    
            if($data['status'] == 'run')
            {
                return $this->renderAjax('import-run-ajax', [
                    'data' => $data,
               ]);    
            }

        } else {
            throw new NotFoundHttpException();
        }
    }

}