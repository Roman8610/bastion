<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Orders $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content-wrapper">
    <div class="content">
        <div class="orders-view">

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
                    'name',
                    'last_name',
                    'phone',
                    'email:email',
                    'message',
                   // 'status',
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
                ],
            ]) ?>

        </div>
    </div>
</div>
