<div class="card card-widget widget-user-2" style="width: 30%;">
      <!-- <div class="widget-user-header bg-success">
        <h3 class="widget-user-username" style="margin-left: 5px;">Импорт товаров запущен</h3>
      </div> -->
      <div class="card-footer p-0">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a  class="nav-link" style="color: #212529;">
              Добавлено категорий <span class="float-right badge bg-success"><?=$data['addCat']?></span>
            </a>
          </li>
          <li class="nav-item">
          <a  class="nav-link" style="color: #212529;">
          Пропущено категорий <span class="float-right badge bg-danger"><?=$data['skippedCat']?></span>
          </a>    
            
          </li>
          <li class="nav-item">
            <a  class="nav-link" style="color: #212529;">
              Добавлено товаров <span class="float-right badge bg-success"><?=$data['addProd']?></span>
            </a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" style="color: #212529;">
              Пропущено товаров <span class="float-right badge bg-danger"><?=$data['skippedProd']?></span>
            </a>
          </li>
        </ul>
      </div>
</div>