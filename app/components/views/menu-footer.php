<?php
use yii\helpers\Url;
?>
<div>
            <div class="font-bold text-gray-200 text-lg">Каталог</div>
            <ul class="mt-4">

            <?php foreach($categories as $category):?>
              <li><a href="<?=Url::to(['catalog/index', 'alias'=>$category->alias])?>" class="text-sm text-gray-200 hover:text-sky-500"><?=$category->title?></a></li>
            <?php endforeach;?>

            </ul>
</div>