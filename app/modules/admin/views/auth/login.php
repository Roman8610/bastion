<?php
    use yii\bootstrap5\ActiveForm;
?>
<div class="login-box">

<?//=Yii::$app->security->generatePasswordHash('ztTfD2dYUw')?>

  <div class="login-logo">
    <a href="../../index2.html"><b>Управление</b>Сайтом</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Введите логин и пароль</p>
      
      <?php $form = ActiveForm::begin()?>

      <?=$form->field($model, 'username')->label('Логин')?>

      <?=$form->field($model, 'password')->passwordInput()->label('Пароль')?>

      <?=$form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня')?>

      <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
       </div>

      <?php ActiveForm::end()?>

      <!-- <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Логин">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Пароль">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Запомнить меня
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
          </div>
        </div>
      </form> -->


    <!-- /.login-card-body -->
  </div>
</div>