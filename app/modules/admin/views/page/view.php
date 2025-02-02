<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Page $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="content-wrapper">
    <div class="content">

        <div class="page-view">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',                  
                    'title_menu',                
                    'text:html',
                    [
                        'attribute'=>'img',
                        'value' => function($data) { return '/'.$data->img; },
                        'format' => ['image', ['width'=>'150px']],
                    ],
                    // [
                    //     'attribute' => 'text',
                    //     'format' => 'html',
                    // ],
                    'title_seo',
                    'description_seo',
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
                        'attribute' => 'show_icons_block',
                        'value' => function($data) { 
                            if($data->show_icons_block == '1')
                            {
                                return '<p class="text-success">Да</p>';
                            } 
                            if($data->show_icons_block == '0')
                            {
                                return '<p class="text-danger">Нет</p>';
                            } 
                        },
                    'format' => 'raw',
                    ],

                ],
            ]) ?>

        </div>

    </div>
</div>
