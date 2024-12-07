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

<?=BreadcrumbsWidget::widget(['category_id' => $category->id_import,])?>


          <div class="product-info mt-4">
            <div class="flex flex-wrap">
              <div class="basis-full lg:basis-1/4">
                <div class="product-card p-4 border rounded-md flex flex-wrap items-center gap-8 lg:block">
                  <div class="product-card__img-wrapper text-center">
                    <?php if($product->img):?>
                      <img src="<?='../'.$product->img?>" alt="" class="product-card__img inline-block rounded-md w-36 h-36 basis-full sm:basis-auto object-contain">
                    <?php else:?>
                      <img src="/images/placeholder.jpg" alt="" class="product-card__img inline-block rounded-md w-36 h-36 basis-full sm:basis-auto object-contain">
                    <?php endif;?>
                  </div>

                  <div class="mt-4 basis-full sm:basis-auto">
                    <div class="price font-bold text-2xl text-sky-500 text-left lg:text-center">
                      Цена по запросу
                    </div>
                    <div class="mt-4 text-left lg:text-center">
                      <a href="#" class="btn-outline" x-data="modalTrigger('request')" x-bind="trigger"
                        data-info='{"modalTitle":"Заказать в 1 клик","title":"<?=$product->title?>", "price":"Цена по запросу", "image":"/images/placeholder.jpg" }'>Купить
                        в 1 клик</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="basis-full lg:basis-3/4 pl-0 lg:pl-8 mt-4 lg:mt-0">
                <h1 class="font-bold text-2xl text-gray-700"><?=$product->title?>
                </h1>

                <div class="product-info__descr mt-35 mb-40">
                  <?=$product->description?>
                </div>

                <div class="tabs mt-8 " x-data="{active:'features'}">
                  <nav class="flex border-b border-gray-100 text-sm font-medium">
                    <a href="#" @click.prevent="active = 'features'" class="-mb-px border-b p-4"
                      :class="active === 'features' ? 'border-current text-sky-500':'border-transparent '">
                      Характеристики
                    </a>

                    <!-- <a href="#" @click.prevent="active = 'reviews'" class="-mb-px border-b p-4 hover:text-sky-500"
                      :class="active === 'reviews' ? 'border-current text-sky-500':'border-transparent '">
                      Отзывы
                    </a> -->
                  </nav>

                  <div class="tabs-content mt-4">
                    <div class="tab" x-show="active === 'features'">
                      <div class="overflow-x-auto">
                        <!-- <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                          <tbody class="divide-y divide-gray-200">
                            <tr class="odd:bg-gray-100">
                              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Артикул
                              </td>
                              <td class="whitespace-nowrap px-4 py-2 text-gray-700">1854</td>
                            </tr>

                            <tr class="odd:bg-gray-100">
                              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Частота
                              </td>
                              <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                3
                              </td>
                            </tr>
                            <tr class="odd:bg-gray-100">
                              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Сокет
                              </td>
                              <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                sWRX8
                              </td>
                            </tr>
                            <tr class="odd:bg-gray-100">
                              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Количество ядер
                              </td>
                              <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                16 шт
                              </td>
                            </tr>

                          </tbody>
                        </table> -->

                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                          <tbody class="divide-y divide-gray-200">
                            <?php foreach($params as $param):?>

                              <tr class="odd:bg-gray-100">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                  <?=$param->value->group->title?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                  <?=$param->value->value?>
                                </td>
                              </tr>

                           
                            <?php endforeach;?>
                          </tbody>
                        </table>

                      </div>
                    </div>
                    <div class="tab" x-show="active === 'reviews'">
                      <div class="py-4 flex justify-end">
                        <a href="#" x-data="modalTrigger('review')" x-bind="trigger" class="btn">⭐ Оставить отзыв</a>
                      </div>
                      <blockquote class="rounded-lg bg-sky-100 p-8 mb-4">
                        <div class="flex items-center gap-4">
                          <div>
                            <div class="flex gap-0.5 text-yellow-500">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            </div>

                            <p class="mt-1 text-lg font-medium text-gray-700">Дмитрий Тест</p>
                          </div>
                        </div>

                        <div class="line-clamp-2 sm:line-clamp-none mt-4 text-gray-500">
                          Хороший проц
                        </div>
                        <div class="mt-4 line-clamp-2 sm:line-clamp-none mt-4 text-gray-500">
                          <div><strong>Плюсы: </strong></div>
                          <div class="mt-2">
                            Да
                          </div>
                        </div>
                        <div class="mt-4 line-clamp-2 sm:line-clamp-none mt-4 text-gray-500">
                          <div><strong>Минусы: </strong></div>
                          <div class="mt-2">
                            Нет
                          </div>
                        </div>
                      </blockquote>
                      <blockquote class="rounded-lg bg-sky-100 p-8 mb-4">
                        <div class="flex items-center gap-4">
                          <div>
                            <div class="flex gap-0.5 text-yellow-500">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            </div>

                            <p class="mt-1 text-lg font-medium text-gray-700">Андрюшка</p>
                          </div>
                        </div>

                        <div class="line-clamp-2 sm:line-clamp-none mt-4 text-gray-500">
                          Нормуль
                        </div>
                        <div class="mt-4 line-clamp-2 sm:line-clamp-none mt-4 text-gray-500">
                          <div><strong>Плюсы: </strong></div>
                          <div class="mt-2">
                            Плюсы!
                          </div>
                        </div>
                      </blockquote>
                    </div>
                  </div>
                </div>

                <?php if($product->docs):?>
                  <section class="section mt-35">
                    <header class="section__header">
                      <h2 class="section__title">Техническая документация</h2>
                    </header>
                    <div class="doc-download-wrapper">
                      <?php foreach($product->docs as $doc):?>
                        <a class="doc-download" target="_blank" href="../<?=$doc->path_doc?>">
                          <img class="doc-download__icon" src="../images/pdf.png" alt="">
                          <div class="doc-download__text">Технический паспорт FS7M0880YDTU (0772729313)</div>
                        </a> 
                      <?php endforeach;?>  
                    </div>
                  </section>
                <?php endif;?>
              </div>
            </div>

            <div class="mt-8">
              <h1 class="font-bold text-2xl text-gray-700">Похожие товары</h1>
              
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-8">
                <?php foreach($similar_products as $similar_product):?>
                    <div class="product-card rounded-md bg-white drop-shadow-lg p-4 text-center lg:text-left mb-4 lg:mb-0">
                    <a href="<?=Url::to(['product/index', 'alias' => $similar_product->alias])?>"
                        class="product-card__img-wrapper block text-center lg:text-left">
                     <!--   <img src="/images/placeholder.jpg" alt=""
                        class="inline-block rounded-md w-[224px] h-[224px] object-contain"> -->
                      <?php if($similar_product->img):?>
                        <img src="<?='../'.$similar_product->img?>" alt="" class="product-card__img inline-block rounded-md w-[224px] h-[224px] object-contain">
                      <?php else:?>
                        <img src="/images/placeholder.jpg" alt="" class="product-card__img inline-block rounded-md w-[124px] h-[124px] object-contain">
                      <?php endif;?>
                    </a>
                    <div class="mt-2">
                       <a href="" class="text-sm font-light text-gray-300"><?//=$category->title?></a>
                    </div>
                    <div class="mt-2">
                        <a href="<?=Url::to(['product/index', 'alias' => $similar_product->alias])?>"
                        class="text-sm font-bold text-gray-500"><?=$similar_product->title?></a>
                    </div>
                    <div class="mt-2 text-sm text-gray-500 font-light">
                        Цена по запросу
                    </div>
                    <div class="mt-4">
                        <a href="#" class="btn-outline" x-data="modalTrigger('request')" x-bind="trigger"
                        data-info='{"modalTitle":"Заказать в 1 клик","title":"<?=$similar_product->title?>", "price":"Цена по запросу", "image":"/images/placeholder.jpg" }'>Заказать
                        в 1 клик</a>
                    </div>

                    </div>
                <?php endforeach;?>
              </div>
            </div>

          </div>