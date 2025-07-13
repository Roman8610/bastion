<?php
use app\components\ImportViewWidget;
?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Импорт товаров</h1>
          </div>
          <div class="col-sm-6">

          </div>
        </div>
      </div>
    </div>
    <div class="content">

          <div id = "process">

              <?=ImportViewWidget::widget([
                  'model' => $model,
              ])?>

          </div>
        

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">История импортов</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Дата</th>
                    <th>Добавлено категорий</th>
                    <th>Пропущено категорий</th>
                    <th>Добавлено товаров</th>
                    <th>Пропущено товаров</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; ?>
                  <?php foreach($imports as $import):?>
                  <?php $i++; ?>
                  <tr>
                    <td><?=$i.'.'?></td>
                    <td><?=$import->date?></td>
                    <td><?=$import->add_cat?></td>
                    <td><?=$import->skipped_cat?></td>
                    <td><?=$import->add_prod?></td>
                    <td><?=$import->skipped_prod?></td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
        </div>
        


    </div> 
</div>

<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>