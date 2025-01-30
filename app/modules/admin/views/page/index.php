<?php

use app\modules\admin\models\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrapper">
 <div class="content">
    <div class="page-index">
    <?=\Yii::$app->session->getFlash('success');?>
    <?=\Yii::$app->session->getFlash('errors');?>
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'title',
                //'parent_id',
                [
                    'attribute' => 'parent_id',
                    'value' => function($data){
            
                            if($data->parent_id == 0)
                            {
                                return 'Самостоятельная категоря';
                            } 
                            else
                            {
                                return $data->parent->title;
                            }      

                        }
                ],
                //'title_seo',
                'title_menu',
                //'description_seo',
                //'text:ntext',               
                'priority',
                //'status',
                [
                    'attribute' => 'status',
                    'value' => function($data) { 
                            if($data->status == '1')
                            {
                                return '<p class="text-success">Опубликовано</p>';
                            } 
                            if($data->status == '0')
                            {
                                return '<p class="text-danger">Не опубликовано</p>';
                            } 
                        },
                    'format' => 'raw',
                ],
                //'show_main',
                [
                    'attribute' => 'show_main',
                    'value' => function($data) { 
                            if($data->show_main == '1')
                            {
                                return '<p class="text-success">Да</p>';
                            } 
                            if($data->show_main == '0')
                            {
                                return '<p class="text-danger">Нет</p>';
                            } 
                        },
                    'format' => 'raw',
                ],
                //'show_footer',
                [
                    'attribute' => 'show_footer',
                    'value' => function($data) { 
                            if($data->show_footer == '1')
                            {
                                return '<p class="text-success">Да</p>';
                            } 
                            if($data->show_footer == '0')
                            {
                                return '<p class="text-danger">Нет</p>';
                            } 
                        },
                    'format' => 'raw',
                ],

                [
                    'attribute' => 'show_footer_1',
                    'value' => function($data) { 
                            if($data->show_footer_1 == '1')
                            {
                                return '<p class="text-success">Да</p>';
                            } 
                            if($data->show_footer_1 == '0')
                            {
                                return '<p class="text-danger">Нет</p>';
                            } 
                        },
                    'format' => 'raw',
                ],

                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Page $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>


    </div>
 </div>
</div>
