<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin()?>

<?=$form->field($model, 'file')->fileInput()->label(false)?>

<div class="form-group">
    <?= Html::submitButton('Импорт', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end()?>