<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Page $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($arr_page) ?>

    <?= $form->field($model, 'title_menu')->textInput(['maxlength' => true]) ?> 

    <?//= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::class, [

        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),

        ]); ?>

    <h2 style="margin-top: 70px;">Метатеги</h2>

    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_seo')->textInput() ?>

    <h2 style="margin-top: 70px;">Настройки</h2>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Не опубликована',  '1' => 'Опубликована', ]) ?>

    <?= $form->field($model, 'show_main')->dropDownList([ '0'=>'Нет', '1' => 'Да', ]) ?>

    <?= $form->field($model, 'show_footer')->dropDownList([ '0'=>'Нет', '1' => 'Да', ]) ?>

    <?= $form->field($model, 'show_footer_1')->dropDownList([ '0'=>'Нет', '1' => 'Да', ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
