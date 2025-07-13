<?php

use app\components\BreadcrumbsWidget;
use yii\helpers\Url;
?>



          <div class="mt-4">
            <h1 class="font-bold text-2xl text-gray-700">Поиск по запросу "<?=$q?>"</h1>



            <section class="listing mt-8">
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php foreach($products as $product):?>
                        <div class="rounded-md bg-white drop-shadow-lg p-4 text-center lg:text-left mb-4 lg:mb-0">
                          <a href="<?=Url::to(['product/index', 'alias' => $product->alias])?>"
                            class="block text-center lg:text-left">
                            <img
                              src="/images/placeholder.jpg"
                              alt="" class="inline-block rounded-md w-[224px] h-[224px] object-contain">
                          </a>
                          <div class="mt-2">
                            <a href="" class="text-sm font-light text-gray-300"></a>
                          </div>
                          <div class="mt-2">
                            <a href="<?=Url::to(['product/index', 'alias' => $product->alias])?>"
                              class="text-sm font-bold text-gray-500"><?=$product->title?></a>
                          </div>
                          <div class="mt-2 text-sm text-gray-500 font-light">
                            Цена по запросу
                          </div>
                          <div class="mt-4">
                            <a href="#" class="btn-outline" x-data="modalTrigger('request')" x-bind="trigger"
                              data-info='{"modalTitle":"Заказать в 1 клик","title":"Процессор AMD Threadripper PRO 3995WX 100-000000087", "price":"Цена по запросу", "image":"storage/app/uploads/public/644/805/9a8/thumb_49929_224_224_0_0_exact.webp" }'>Заказать
                              в 1 клик</a>
                          </div>

                        </div>
                    <?php endforeach;?>
              </div>

              <nav aria-label="" style="margin-top:30px;">

              <?= \yii\widgets\LinkPager::widget([
                  'pagination' => $pages,
                  'nextPageLabel' => 'Следующая',
                  'prevPageLabel' => 'Предыдущая',
                  'pageCssClass' => 'page-item',
                  'disabledPageCssClass' => 'page-link',
                  'maxButtonCount' => 10,
                  'firstPageLabel' => 'К первой',
                  'lastPageLabel' => 'К последней',
                  'linkOptions' => [
                      'class' => 'page-link',
                  ],
                  'options' => [
                      'class' => 'pagination',
                  ],

              ])?>
                  
              </nav>

            </section>
          </div>