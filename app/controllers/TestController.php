<?php
namespace app\controllers;

class TestController extends AppController
{
    public function actionIndex()
    {

        // echo random_int(10000000, 99999999);

        // die;




        return $this->render('index', compact('a'));
    }
}