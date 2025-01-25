<?php
use yii\helpers\Url;
?>
<div class="basis-full mt-4 lg:mt-8">
    <h1 class="h2">Новости</h1>
    <div class="mt-8 grid grid cols-1 lg:grid-cols-2 gap-10">

        <?php foreach($news as $new):?>
        <article class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm">
            <img alt="" src="<?='/'.$new->img?>" class="h-56 w-full object-cover">
            
            <div class="p-4 sm:p-6">
                <a href="<?=Url::to(['news/view', 'id'=>$new->id])?>">
                    <h3 class="text-lg font-medium text-gray-900">
                        <?=$new->title?>
                    </h3>
                </a>

                <div class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                    <p style="text-align: justify;"><?=$new->short_text?></p>
                </div>

                <a href="<?=Url::to(['news/view', 'id'=>$new->id])?>" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
                    Читать дальше

                    <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                →
            </span>
                </a>
            </div>
        </article>  
        <?php endforeach;?>
        
    </div>
</div>