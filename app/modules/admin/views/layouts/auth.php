<?php

use app\assets\AuthAsset;
use yii\bootstrap5\ActiveForm;

AuthAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Авторизация</title>

  <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>

<?=$content?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>