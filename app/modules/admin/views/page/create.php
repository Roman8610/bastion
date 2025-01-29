<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Page $model */

$this->title = 'Добавление новой страницы';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrapper">
 <div class="content">

    <div class="page-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'arr_page' => $arr_page,
        ]) ?>

    </div>
    
 </div>
</div>
