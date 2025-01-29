    <?php
      use yii\helpers\Url;
    ?>
    <div class="top bg-gray-200 hidden md:block">
      <nav class="container mx-auto">
        <ul class="menu flex gap-8 h-10">
           
        <?php foreach($pages as $page):?>

            <?php if(!$page->children):?>

              <?php //var_dump($priority_news); die;?>

                <?php if($priority_news > $page->priority && $priority_news != null): ?>
                
                  <li class="menu__li"><a href="<?=Url::to('/news/index')?>" class="menu__a hover:text-sky-500">Новости</a></li>
                  <?php $priority_news = null; ?>
                
                <?php endif; ?>

                <li class="menu__li"><a href="<?=Url::to(['/pages/view', 'alias' => $page->alias])?>" class="menu__a hover:text-sky-500"><?=$page->title_menu?></a></li>
                

            <?php else:?>
            <li class="menu__li">
                <div class="menu__a hover:text-sky-500"><?=$page->title?></div>
                <ul class="menu-child">
                    <?php foreach($page->children as $child):?>
                         <li class="menu-child__li"><a href="<?=Url::to(['/pages/view', 'alias' => $child->alias])?>" class="menu-child__a hover:text-sky-500"><?=$child->title_menu?></a></li>
                    <?php endforeach;?>
                </ul>
            </li>

            <?php endif;?>

        <?php endforeach;?>
          
        </ul>
      </nav>
    </div>