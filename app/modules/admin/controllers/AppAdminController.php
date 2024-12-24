<?php

namespace app\modules\admin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;


class AppAdminController extends Controller
{

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        $this->view->params['countNewOrders'] = \app\modules\admin\models\Orders::find()->where(['status' => '0'])->count();
    }

    public function beforeAction($action)
    {            
        if ($action->id == 'delete') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

}