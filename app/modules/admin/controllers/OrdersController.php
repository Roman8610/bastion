<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Orders;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\AppAdminController;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class OrdersController extends AppAdminController
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Orders::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Orders();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id, true)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id, $del = false)
    {
        if (($model = Orders::findOne(['id' => $id])) !== null) {

            if($model->file_path)
            {
                if(is_file($model->file_path) && $del === true)
                {
                    unlink($model->file_path);
                }
            }
            
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
