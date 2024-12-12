<?php

use app\modules\admin\models\News;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="content-wrapper">
    <div class="content">
        <div class="news-index">

            <h1>Новости</h1>

            <p>
                <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    'short_text',
                    'text:ntext',
                    'img',
                    //'date',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, News $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>


        </div>
    </div>
 </div>
