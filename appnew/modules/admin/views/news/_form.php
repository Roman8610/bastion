<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use phpnt\datepicker\BootstrapDatepicker;
mihaildev\elfinder\Assets::noConflict($this);

/** @var yii\web\View $this */
/** @var app\modules\admin\models\News $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::class, [

  'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),

]); ?>

    <?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?php if($model->img):?>
        <?=Html::img('@web/'.$model->img, ['style' => 'height: 150px; margin-bottom: 20px;'])?>
    <?php endif;?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>


    <?//= $form->field($model, 'date')->textInput() ?>





    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
