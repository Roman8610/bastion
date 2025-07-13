<?php
use yii\helpers\Url;
?>
<div class="mt-8">
            <section>
            <h2 class="h2">Услуги</h2>
              <div class="container mx-auto">
                <div class="grid grid-cols-6 md:grid-cols-4 lg:grid-cols-5 gap-8">

                <?php foreach($pages as $page):?>
                  <a href="<?=Url::to(['pages/view', 'alias' => $page->alias])?>"
                    class="base_featured_menu flex flex-col gap-4 rounded-md bg-gray-100 hover:drop-shadow-lg text-center justify-center items-center">
                    <img src="/<?=$page->img?>" alt="">
                    <span class="font-light text-sm"><?=$page->title_menu?></span>
                  </a>
                <?php endforeach;?>

                </div>
              </div>
            </section>
 </div>