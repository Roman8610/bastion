<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Exception;
use yii\data\Pagination;

class PagesController extends AppController
{
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHowWeWork()
    {
        return $this->render('how-we-work');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionBastionEk()
    {
        return $this->render('bastion-ek');
    }

    public function actionDelivery()
    {
        return $this->render('delivery');
    }

    public function actionPaymentMethods()
    {
        return $this->render('payment-methods');
    }

    public function actionRefundAndExchange()
    {
        return $this->render('refund-and-exchange');
    }

    public function actionSupplyOfElectronicsAbroad()
    {
        return $this->render('supply-of-electronics-abroad');
    }

    public function actionLegalInformation()
    {
        return $this->render('legal-information');
    }

    public function actionPrivacy()
    {
        return $this->render('privacy');
    }

    public function actionSearchEc()
    {
        return $this->render('search-ec');
    }

    public function actionLaboratoryControl()
    {
        return $this->render('laboratory-control');
    }

    public function actionExpressDelivery()
    {
        return $this->render('express-delivery');
    }

    public function actionPurchaseEc()
    {
        return $this->render('purchase-ec');
    }

    public function actionWarehouseServices()
    {
        return $this->render('warehouse-services');
    }
}