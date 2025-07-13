<?php
use yii\helpers\Url;
?>

<ul class="flex flex-col lg:flex-row gap-4 mt-4 lg:mt-0">
    <?php

    foreach($pages as $page):?>
          <li><a href="<?=Url::to(['/pages/view', 'alias' => $page->alias])?>" target="_blank" class="text-sm text-stone-500 hover:text-sky-500"><?=$page->title_menu?></a></li>
    <?php endforeach;?>     
		  <li><a href="/sitemap" class="text-sm text-stone-500 hover:text-sky-500">Карта сайта</a></li>
</ul>