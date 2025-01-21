<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\News;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class NewsController extends AppAdminController
{
    /**
     * @inheritDoc
     */
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
            'query' => News::find(),
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

        $model = new News();

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                if($model->save())
                {                   
                    return $this->redirect(['view', 'id' => $model->id]);
                }

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

        $model->current_img = $model->img;

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }

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
        if (($model = News::findOne(['id' => $id])) !== null) {

            if($model->img && $model->img != 'images/news/default-new.webp')
            {

                if(is_file($model->img) && $del === true)
                {
                    unlink($model->img);
                }

            }

            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
