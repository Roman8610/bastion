<?php
use yii\helpers\Url;
?>
        <div class="footer__col">
            <div class="font-bold text-gray-200 text-lg">Информация</div>
            <ul class="mt-4">
                <?php foreach($pages as $page):?>
                    <li><a href="<?=Url::to(['/pages/view', 'alias' => $page->alias])?>" class="text-sm text-gray-200 hover:text-sky-500"><?=$page->title_menu?></a></li>
                <?php endforeach;?>
            </ul>
          </div>