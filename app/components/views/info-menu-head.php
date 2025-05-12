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

        <?php if($priority_news != null):?>
          <li class="menu__li"><a href="<?=Url::to('/news/index')?>" class="menu__a hover:text-sky-500">Новости</a></li>
        <?php endif;?>
          
        </ul>
      </nav>
    </div>
  
    <div x-data x-cloak data-modal="nav" x-show="$store.modals.find('nav').active" x-transition.opacity
    class="fixed w-full h-full z-50 top-0 left-0 bg-black bg-opacity-70 flex items-center justify-end">
      <div class="h-screen overflow-y-auto w-[90%] md:w-2/4 xl:w-1/4 bg-white relative pt-4" x-data
        @click.outside="$store.modals.nav = false">
        <button x-data @click="$store.modals.close('nav')" aria-label="Close"
          class="absolute top-8 right-4 z-10 border-0 bg-transparent text-black">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <nav>
          <div class="font-bold text-2xl b-4 border-b p-4">Навигация</div>
          <ul class="menu-mobile mt-4">

          <?php foreach($pages as $page):?>

                  <?php if(!$page->children):?>

                    <?php if($priority_news > $page->priority && $priority_news != null): ?>
                    
                      <a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/news/index">Новости</a></li>
                      <?php $priority_news = null; ?>
                    
                    <?php endif; ?>

                    <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="<?=Url::to(['/pages/view', 'alias' => $page->alias])?>"><?=$page->title_menu?></a></li>

                    <?php else:?>
                    <li>
                        <div class="block hover:bg-sky-500 hover:text-white px-4 py-2">Услуги</div>
                        <ul class="menu-child">
                            <?php foreach($page->children as $child):?>
                              <li class="menu-child__li"><a href="<?=Url::to(['/pages/view', 'alias' => $child->alias])?>" class="hover:bg-sky-500 hover:text-white menu-child__a hover:text-sky-500"><?=$child->title_menu?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </li>

                    <?php endif;?>

          <?php endforeach;?>

        <?php if($priority_news != null):?>
        <li class="menu__li"><a href="<?=Url::to('/news/index')?>" class="menu__a hover:text-sky-500">Новости</a></li>
        <?php endif;?>


            <!-- <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/about">О нас</a></li>
            <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/news/index">Новости</a></li>
            <li>
              <div class="block hover:bg-sky-500 hover:text-white px-4 py-2">Услуги</div>
              <ul class="menu-child">
                <li class="menu-child__li"><a href="<?=Url::to('/pages/production')?>" class="hover:bg-sky-500 hover:text-white menu-child__a hover:text-sky-500">Производство</a></li>
                <li class="menu-child__li"><a href="<?=Url::to('/pages/revers-engineering')?>" class="hover:bg-sky-500 hover:text-white menu-child__a hover:text-sky-500">Реверс-инжиниринг</a></li>
                <li class="menu-child__li"><a href="<?=Url::to('/pages/laboratory-monitoring')?>" class="hover:bg-sky-500 hover:text-white menu-child__a hover:text-sky-500">Лабораторный контроль</a></li>
              </ul>
            </li> -->
            <!-- <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/how-we-work">Как мы работаем</a></li> -->
            <!-- <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/contact">Контакты</a></li> -->
            <!-- <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/bastion-ek">Бастион ЭК</a></li> -->
            
          </ul>
        </nav>
        <div class="mt-8 pb-4">
          <div class="font-bold text-2xl b-4 border-b p-4">Контакты</div>

          <div class="px-4">
            <div class="mt-4">
              <div class="text-lg">с 8:00 до 22:00</div>
              <div class="text-sm font-light text-gray-500">без выходных</div>
            </div>
            <div class="mt-4">
              <a href="tel:88129208520" class="font-bold text-lg">8 (812) 920-85-20</a>
              <div class="text-sm font-light text-gray-500">многоканальный</div>
            </div>

            <a href="mailto:sales@bastion24.ru"
              class="block mt-4 font-bold text-lg hover:text-sky-500">sales@bastion24.ru</a>

            <a href="#" class="btn flex w-full mt-4" x-data @click.prevent="$store.modals.open('callback')">
              Заказать звонок
            </a>
          </div>
        </div>
      </div>
    </div>
    