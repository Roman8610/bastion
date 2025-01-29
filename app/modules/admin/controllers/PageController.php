<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Page;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends AppAdminController
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

    /**
     * Lists all Page models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find(),
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

    /**
     * Displays a single Page model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($this->request->isPost) {

            $model->alias = $this->getAlias($_POST['Page']['title']);

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $arr_page = $this->getArr();

        return $this->render('create', [
            'model' => $model,
            'arr_page' => $arr_page,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $arr_page = $this->getArr();

        return $this->render('update', [
            'model' => $model,
            'arr_page' => $arr_page,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       // $this->findModel($id)->delete();

       $child = Page::find()->where(['parent_id' => $id])->count();
        
        if($child){
            $session = \Yii::$app->session;
            $session->open();
            $session->setFlash('errors', '<div class="alert alert-danger alert-dismissible">
                  
                <h5><i class="icon fas fa-ban"></i> Ошибка!</h5>
                  Невозможно удалить страницу т.к. есть дочерние элементы
                </div>');
            return $this->redirect(['index']);
        }
        
        $this->findModel($id)->delete();
        
        $session = \Yii::$app->session;
        $session->open();
        $session->setFlash('success', '<div class="alert alert-success alert-dismissible">
                  
                <h5></h5>
                  Страница удалена успешно
                </div>');


        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getArr(){
        $arr_page = Page::find()
                ->asArray()
                ->indexBy('id')
                ->select('id, parent_id, title')
                ->orderBy('priority DESC')
                ->all();
        
        $arr[0] = 'Самостоятельная категория';        
        foreach ($arr_page as $k => $v){
            $arr[$k] = $v['title'];
        }
       
        return $arr;        
    }

    public function getAlias($value){
        $converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
	);
 
	$value = mb_strtolower($value);
	$value = strtr($value, $converter);
	$value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
	$value = mb_ereg_replace('[-]+', '-', $value);
	$value = trim($value, '-');	
        $value = $this->checkUnique($value);
	return $value;
    }
    
    public function checkUnique($value, $i = 1)
    {
        if(!Page::find()->where(['alias' => $value])->count()){
             return $value;
        } 
        else 
        {
             $value .= "-$i";
             $i++;
             $value = $this->checkUnique($value, $i);
        }
        return $value;
    }
    
}
