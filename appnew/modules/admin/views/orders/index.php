<?php

use app\modules\admin\models\Orders;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrapper">
    <div class="content">
        <div class="orders-index">

            <h1>Заказы</h1>

            <p>
                <?//= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                   // 'id',
                    'name',
                    'last_name',
                    'phone',
                    'email:email',
                    'message',
                  //  'file_path',
                    [
                        'attribute' => 'file_path',
                        'value' => function($data) { 

                            if($data->file_path)
                            {
                                return '<a href=/'.$data->file_path.'>Скачать файл</a>'; 
                            }
                            else
                            {
                                return ''; 
                            }

                            
                        
                        },
                        'format' => 'html',
                    ],
                  //  'status',
                    [
                        'attribute' => 'status',
                        'value' => function ($data){
                                switch ($data->status) {
                                        case 0:
                                            return '<span class="text-danger">Новая</span>';                                                
                                        case 1:
                                            return '<span class="text-success">Обработана</span>';
                                            }
                                            

                        },
                        'format' => 'html',
                    ],
                    'created_at',
                    'updated_at',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>


        </div>
    </div>
</div>
