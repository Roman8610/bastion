
<?php 

// echo '<pre>';
// print_r($categories);
// echo '</pre>'

use yii\helpers\Html;
use yii\helpers\Url;

?>

<aside class="basis-full lg:basis-1/4 relative mt-8 lg:mt-0">
<a href="#" class="btn-outline w-full" x-data="modalTrigger('request')" x-bind="trigger"
  data-info='{"modalTitle":"Заказать компонент"}'>Заказать компонент</a>

<nav class="categories mt-4 lg:mt-8 sticky top-4" x-data="{catalogExpanded:window.innerWidth >= 768}">
  <div
    class="h-[50px] lg:h-auto bg-sky-500 px-4 py-2 text-white text-md font-semibold flex justify-between items-center rounded-t-md"
    :class="catalogExpanded ? '' : 'rounded-b-md'" @click.prevent="catalogExpanded = !catalogExpanded">
    <span>Каталог товаров</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 400 400" fill="none">
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M15 84.125C15 71.3534 25.3534 61 38.125 61H361.875C374.647 61 385 71.3534 385 84.125C385 96.8966 374.647 107.25 361.875 107.25H38.125C25.3534 107.25 15 96.8966 15 84.125ZM15 199.75C15 186.978 25.3534 176.625 38.125 176.625H361.875C374.647 176.625 385 186.978 385 199.75C385 212.522 374.647 222.875 361.875 222.875H38.125C25.3534 222.875 15 212.522 15 199.75ZM176.875 315.375C176.875 302.603 187.228 292.25 200 292.25H361.875C374.647 292.25 385 302.603 385 315.375C385 328.147 374.647 338.5 361.875 338.5H200C187.228 338.5 176.875 328.147 176.875 315.375Z"
        fill="currentColor"></path>
    </svg>
  </div>

  <ul class="bg-gray-100" x-show="catalogExpanded" x-collapse>
  <?php foreach ($categories as $category):?>

    <?php if(!$category->children):?>

      <li>
        <a href="<?=Url::to(['catalog/index', 'alias' => $category->alias])?>" class="block py-2 px-4 text-sm hover:text-sky-500 ">
          <?=$category->title?>
        </a>
      </li>
    
    <?php else:?>
      <li x-data="{expanded:false}">
        <a href=""
          class="block py-2 px-4 text-sm hover:text-sky-500 flex items-center justify-between"
          @click.prevent="expanded = !expanded">
          <span><?=$category->title?></span>
          <span class="transform" :class="expanded ? 'arrow-180' : 'arrow-90'">
            <svg role="img" aria-hidden="true" data-icon="chevron" width="12" height="12" viewBox="0 0 24 24"
              name="chevron">
              <path
                d="M4.8 16.2a1 1 0 0 0 1.4 0l6.3-6.29 6.3 6.3a1 1 0 0 0 1.4-1.42l-7-7a1 1 0 0 0-1.4 0l-7 7a1 1 0 0 0 0 1.42Z"
                fill="currentColor"></path>
            </svg>
          </span>
        </a>
        <ul class="bg-gray-200" x-show="expanded" x-collapse>

        <?php foreach ($category->children as $child):?>

          <li>
            <a class="block py-2 px-4 pl-8 font-bold text-sm hover:text-sky-500 " href="<?=Url::to(['catalog/index', 'alias' => $child->alias])?>">
            <?=$child->title?>
            </a>
          </li>

        <?php endforeach;?>

        </ul>
      </li>

    <?php endif;?>

  <?php endforeach; ?>

  </ul>
</nav>

</aside>