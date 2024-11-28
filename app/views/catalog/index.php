<?php

use app\components\BreadcrumbsWidget;
use yii\helpers\Url;
?>
<!-- <nav aria-label="Breadcrumb" class="mt-4">
            <ol class="flex items-center gap-1 text-sm text-gray-600">
              <li>
                <a href="#" class="block transition hover:text-sky-500">
                  <span class="sr-only"> Главная </span>

                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </svg>
                </a>
              </li>

              <li class="rtl:rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </li>

              <li>
                <a href="#" class="block transition hover:text-sky-500"> Процессоры </a>
              </li>

              <li class="rtl:rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </li>

              <li>
                <a href="#" class="block transition hover:text-sky-500"> Intel </a>
              </li>
            </ol>
</nav> -->

<?=BreadcrumbsWidget::widget([
    'category_id' => $categry_current->id_import,
])?>

          <div class="mt-4">
            <h1 class="font-bold text-2xl text-gray-700"><?=$categry_current->title?></h1>

            <div class="catalog-list prose mt-4">
                <ol>
                    <?php foreach($child_categories as $child_category):?>
                        <li>
                            <a href="<?=Url::to(['catalog/index', 'alias' => $child_category->alias])?>" class="hover:text-sky-500"><?=$child_category->title?></a>
                        </li>
                    <?php endforeach;?>
                </ol>
            </div>

            <section class="listing mt-8">
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php foreach($products as $product):?>
                        <div class="product-card rounded-md bg-white drop-shadow-lg p-4 text-center lg:text-left mb-4 lg:mb-0">
                          <a href="<?=Url::to(['product/index', 'alias' => $product->alias])?>"
                            class="product-card__img-wrapper block text-center lg:text-left">
                            <?php if($product->img):?>
                              <img src="<?='../'.$product->img?>" alt="" class="product-card__img inline-block rounded-md w-[224px] h-[224px] object-contain">
                            <?php else:?>
                              <img src="/images/placeholder.jpg" alt="" class="product-card__img inline-block rounded-md w-[224px] h-[224px] object-contain">
                            <?php endif;?>
                          </a>
                          <div class="mt-2">
                            <a href="" class="text-sm font-light text-gray-300"><?=$categry_current->title?></a>
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
                  'firstPageLabel' => 'К&nbsp;первой',
                  'lastPageLabel' => 'К&nbsp;последней',
                  'linkOptions' => [
                      'class' => 'page-link',
                  ],
                  'options' => [
                      'class' => 'pagination',
                  ],

              ])?>
                  
              </nav>

              <!-- <ol class="flex justify-center gap-1 text-xs font-medium mt-16">

                <li class="block h-8 w-8 rounded border-sky-500 bg-sky-500 text-center leading-8 text-white">
                  1
                </li>
                <li>
                  <a href="processory/amd?page=2"
                    class="page-link block h-8 w-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    data-page="2">
                    2
                  </a>
                </li>
                <li>
                  <a href="processory/amd?page=3"
                    class="page-link block h-8 w-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    data-page="3">
                    3
                  </a>
                </li>
                <li>
                  <a href="processory/amd?page=4"
                    class="page-link block h-8 w-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    data-page="4">
                    4
                  </a>
                </li>
                <li>
                  <a href="processory/amd?page=5"
                    class="page-link block h-8 w-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    data-page="5">
                    5
                  </a>
                </li>
                <li class="page-item"><a
                    class="page-link dot page-link block h-8 w-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    href="#">...</a></li>
                <li>
                  <a href="processory/amd?page=7"
                    class="page-link block h-8 w-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    data-page="7">
                    7
                  </a>
                </li>

                <li>
                  <a href="processory/amd?page=2"
                    class="page-link inline-flex h-8 w-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
                    data-page="2">
                    <span class="sr-only">Следующая страница</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                    </svg>
                  </a>
                </li>

              </ol> -->

            </section>
          </div>