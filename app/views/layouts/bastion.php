<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\assets\BastionAsset;
use app\components\MenuFooterWidget;
use app\components\MenuWidget;
use app\components\OrdersFormCallWidget;
use app\components\OrdersFormWidget;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

BastionAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
//$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= Html::encode($this->title) ?></title>
  <!-- <link rel="stylesheet" href="assets/styles/main.min.css" /> -->
  <link rel="shortcut icon" type="image/x-icon" href="storage/app/media/favicon.svg">
  <?php $this->head() ?>
</head>

<body x-data :class="$store.modals.isOpen ? 'overflow-hidden' : ''" class="pt-[75px] md:pt-0">
<?php $this->beginBody() ?>
  <header class="header bg-white drop-shadow-lg md:drop-shadow-none fixed top-0 left-0 z-30 w-full md:relative"
    id="header">
    <div class="top bg-gray-200 hidden md:block">
      <nav class="container mx-auto">
        <ul class="flex gap-8 h-10 items-center">
          <li><a href="<?=Url::to('/news/index')?>" class="hover:text-sky-500">Новости</a></li>
          <li><a href="<?=Url::to('/pages/about')?>" class="hover:text-sky-500">О нас</a></li>
          <li><a href="<?=Url::to('/pages/how-we-work')?>" class="hover:text-sky-500">Как мы работаем</a></li>
          <li><a href="<?=Url::to('/pages/contact')?>" class="hover:text-sky-500">Контакты</a></li>
          <li><a href="<?=Url::to('/pages/bastion-ek')?>" class="hover:text-sky-500">Бастион ЭК</a></li>
        </ul>
      </nav>
    </div>
    <div class="border-b py-2 lg:py-0">
      <div class="container mx-auto flex gap-4 items-center justify-between py-4">
        <a href="/">
          <img src="../images/logo/logo.svg" alt="">
        </a>
        <div class="hidden lg:flex gap-8 items-center">
          <div>
            <div class="text-lg">с 08:00 до 22:00</div>
            <div class="text-sm font-light text-gray-500">без выходных</div>
          </div>
          <div>
            <a href="tel:88129208520" class="font-bold text-lg hover:text-sky-500">8 (812) 920 8520</a>
            <div class="text-sm font-light text-gray-500">многоканальный</div>
          </div>
          <a href="#" class="btn" x-data @click.prevent="$store.modals.open('callback')">
            Заказать звонок
          </a>
          <a href="mailto:info@bastionit.ru" class="font-bold text-lg hover:text-sky-500">info@bastionit.ru</a>
        </div>

        <div class="flex lg:hidden gap-4">
          <button class="border rounded-md p-4 text-sky-500 hover:border-sky-500 hover:bg-sky-500 hover:text-white">
            <svg width="24" height="24" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M23.3156 17.4592L18.0655 15.2092C17.8412 15.1136 17.5919 15.0935 17.3552 15.1518C17.1185 15.2102 16.9071 15.3438 16.753 15.5327L14.4279 18.3733C10.779 16.6529 7.84242 13.7163 6.12198 10.0674L8.96266 7.74236C9.15189 7.58846 9.28582 7.37709 9.34418 7.14026C9.40254 6.90344 9.38215 6.65404 9.2861 6.42984L7.03606 1.17974C6.93064 0.938055 6.7442 0.740726 6.50887 0.62178C6.27355 0.502834 6.0041 0.469727 5.74698 0.528169L0.87189 1.65319C0.623997 1.71043 0.402825 1.85001 0.244474 2.04914C0.0861227 2.24827 -5.71046e-05 2.4952 2.8389e-08 2.74961C2.8389e-08 14.7733 9.74549 24.5 21.7504 24.5C22.0049 24.5002 22.2519 24.414 22.4511 24.2557C22.6504 24.0973 22.79 23.8761 22.8473 23.6281L23.9723 18.753C24.0304 18.4947 23.9966 18.2241 23.8767 17.988C23.7568 17.7519 23.5584 17.5649 23.3156 17.4592Z"
                fill="currentColor"></path>
            </svg>
          </button>
          <button x-data @click.prevent="$store.modals.open('nav')"
            class="border rounded-md p-4 text-sky-500 hover:border-sky-500 hover:bg-sky-500 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 400 400" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M15 84.125C15 71.3534 25.3534 61 38.125 61H361.875C374.647 61 385 71.3534 385 84.125C385 96.8966 374.647 107.25 361.875 107.25H38.125C25.3534 107.25 15 96.8966 15 84.125ZM15 199.75C15 186.978 25.3534 176.625 38.125 176.625H361.875C374.647 176.625 385 186.978 385 199.75C385 212.522 374.647 222.875 361.875 222.875H38.125C25.3534 222.875 15 212.522 15 199.75ZM176.875 315.375C176.875 302.603 187.228 292.25 200 292.25H361.875C374.647 292.25 385 302.603 385 315.375C385 328.147 374.647 338.5 361.875 338.5H200C187.228 338.5 176.875 328.147 176.875 315.375Z"
                fill="currentColor"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>
  <div class="header-fixed block w-full fixed top-0 left-0 z-30 bg-white drop-shadow-lg" x-data
    x-show="$store.headerFixed.scrolled" x-cloak x-transition>
    <div class="container mx-auto">
      <div class="py-2 flex justify-between">
        <div>
          <a href="#" class="btn" x-data @click.prevent="$store.modals.open('callback')">
            Заказать звонок
          </a>
        </div>
        <div class="flex items-center gap-8">
          <div>
            <a href="mailto:info@bastionit.ru" class="text-md hover:text-sky-500">info@bastionit.ru</a>
          </div>
          <div>
            <a href="tel:88129208520" class="font-bold text-lg hover:text-sky-500">8 (812) 920 8520</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <main class="pt-0 lg:pt-8 pb-16">
    <div class="container mx-auto">
      <!-- <div class="flex flex-wrap"> -->
      <div class="flex flex-col lg:flex-row">
      <?=MenuWidget::widget();?> 
        <div class="basis-full lg:basis-3/4 pl-0 lg:pl-8 mt-4 lg:mt-0 lg:mt-0">

          <section class="search">
            <form action="/search/index?q=" method="get" role="search">
              <div class="flex">
                <input name="q" type="text" placeholder="Введите название товара"
                  class="input-text border-r-0 rounded-tr-none rounded-br-none" value="">
                <button type="submit"
                  class="text-white bg-sky-500 border-none w-[48px] h-[48px] rounded-tr-md rounded-br-md flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 400 400" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M65.0346 177.621C65.0346 147.761 76.8964 119.124 98.0104 98.0104C119.124 76.8963 147.761 65.0346 177.621 65.0346C207.481 65.0346 236.118 76.8963 257.232 98.0104C278.346 119.124 290.207 147.761 290.207 177.621C290.207 207.481 278.346 236.118 257.232 257.232C236.118 278.346 207.481 290.208 177.621 290.208C147.761 290.208 119.124 278.346 98.0104 257.232C76.8964 236.118 65.0346 207.481 65.0346 177.621ZM177.621 20C152.646 20 128.028 25.9349 105.796 37.3157C83.5646 48.6965 64.3556 65.1973 49.7522 85.4584C35.1489 105.719 25.5692 129.161 21.8027 153.85C18.0362 178.54 20.1907 203.772 28.0886 227.465C35.9865 251.159 49.4017 272.637 67.2288 290.129C85.0558 307.62 106.784 320.626 130.624 328.072C154.463 335.519 179.731 337.195 204.344 332.96C228.958 328.726 252.213 318.703 272.194 303.718C272.834 304.57 273.534 305.375 274.288 306.127L341.84 373.679C346.086 377.781 351.774 380.05 357.678 379.999C363.582 379.948 369.23 377.58 373.405 373.405C377.58 369.23 379.948 363.582 379.999 357.678C380.05 351.774 377.781 346.086 373.679 341.84L306.127 274.288C305.375 273.534 304.57 272.834 303.718 272.194C321.281 248.776 331.976 220.93 334.605 191.776C337.234 162.622 331.692 133.313 318.602 107.131C305.511 80.949 285.388 58.9298 260.487 43.5406C235.587 28.1513 206.893 20 177.621 20Z"
                      fill="currentColor"></path>
                  </svg>
                </button>
              </div>
            </form>
          </section>
        
          <?=$content?>

        </div>
      </div>
    </div>
  </main>
  <footer>
    <div class="py-8 lg:py-16 bg-stone-700">
      <div class="container mx-auto flex flex-wrap gap-4 justify-between">
        <div class="basis-full lg:basis-auto">
          <a href="/">
            <img src="images/logo/logo-light.svg" alt="">
          </a>
          <div class="mt-4 text-gray-200 text-sm">Контакты</div>
          <div>
            <a href="tel:88129208520" class="font-bold text-lg text-gray-200">8 (812) 920 8520</a>
            <div class="mt-2">
              <a href="mailto:info@bastionit.ru" class="font-bold text-sm text-gray-200">info@bastionit.ru</a>
            </div>
          </div>


          <div class="mt-8 text-gray-200 text-sm">Мы в соцсетях</div>
          <div class="flex mt-4">
            <a target="_blank" href="" title="Телеграм"
              class="mr-2 w-[40px] h-[40px] rounded-full bg-stone-600 flex items-center justify-center text-white hover:bg-sky-500">
              <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M20.7906 1.59144L17.6441 16.43C17.4066 17.4771 16.7877 17.7378 15.9082 17.2448L11.1137 13.7118L8.80056 15.937C8.54437 16.1932 8.33064 16.4069 7.83688 16.4069L8.18169 11.5245L17.067 3.4957C17.4535 3.15163 16.9828 2.96024 16.4667 3.30505L5.48207 10.222L0.753091 8.74152C-0.27537 8.42054 -0.293988 7.71306 0.967571 7.21931L19.4642 0.0930619C20.3207 -0.227913 21.0698 0.282966 20.7906 1.59144Z"
                  fill="white"></path>
              </svg>
            </a>
          </div>
        </div>


        <div class="gap-16 basis-full lg:basis-auto hidden lg:flex">

         <?=MenuFooterWidget::widget([
          
         ])?>

          <div>
            <div class="font-bold text-gray-200 text-lg">Информация</div>
            <ul class="mt-4">
              <li><a href="<?=Url::to('/pages/contact')?>" class="text-sm text-gray-200 hover:text-sky-500">Контакты</a></li>
              <li><a href="<?=Url::to('/pages/delivery')?>" class="text-sm text-gray-200 hover:text-sky-500">Доставка</a></li>
              <li><a href="<?=Url::to('/pages/payment-methods')?>" class="text-sm text-gray-200 hover:text-sky-500">Способы оплаты</a></li>
              <li><a href="<?=Url::to('/pages/refund-and-exchange')?>" class="text-sm text-gray-200 hover:text-sky-500">Возврат и
                  обмен</a></li>
              <li><a href="<?=Url::to('/pages/how-we-work')?>" class="text-sm text-gray-200 hover:text-sky-500">Как мы работаем</a>
              </li>
              <li><a href="<?=Url::to('/pages/supply-of-electronics-abroad')?>"
                  class="text-sm text-gray-200 hover:text-sky-500">Поставка электроники за границей</a></li>
              <li><a href="<?=Url::to('/pages/legal-information')?>" class="text-sm text-gray-200 hover:text-sky-500">Правовая
                  информация</a></li>
            </ul>
          </div>
        </div>

        <div class="hidden lg:block">
          <div class="font-bold text-gray-200 text-lg">Принимаем к оплате</div>
          <div class="mt-8 grid grid-cols-3 gap-4">
            <div class="footer__top-payment-item">
              <svg fill="none" height="14" viewBox="0 0 38 14" width="38">
                <use xlink:href="assets/images/svg/sprite.svg#payment-item-visa"></use>
              </svg>
            </div>
            <div class="footer__top-payment-item">
              <svg fill="none" height="18" viewBox="0 0 28 18" width="28">
                <use xlink:href="assets/images/svg/sprite.svg#payment-item-mc"></use>
              </svg>
            </div>
            <div class="footer__top-payment-item">
              <svg fill="none" height="18" viewBox="0 0 29 18" width="29">
                <use xlink:href="assets/images/svg/sprite.svg#payment-item-maestro"></use>
              </svg>
            </div>
            <div class="footer__top-payment-item">
              <svg fill="none" height="14" viewBox="0 0 52 14" width="52">
                <use xlink:href="assets/images/svg/sprite.svg#payment-item-mir"></use>
              </svg>
            </div>
            <div class="footer__top-payment-item">
              <svg fill="none" height="24" viewBox="0 0 210 120" width="42">
                <use xlink:href="assets/images/svg/sprite.svg#payment-item-sbp"></use>
              </svg>
            </div>
            <div class="footer__top-payment-item">
              <svg fill="none" height="18" viewBox="0 0 68 14" width="87">
                <use xlink:href="assets/images/svg/sprite.svg#payment-item-sb"></use>
              </svg>
            </div>
            <div class="footer__top-payment-item">
              <svg fill="none" height="11" viewBox="0 0 109 20" width="60">
                <use xlink:href="assets/images/svg/sprite.svg#payment-item-halva"></use>
              </svg>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="py-4 bg-stone-900">
      <div class="container mx-auto flex flex-col lg:flex-row justify-between">
        <div class="text-sm text-stone-500">
          &copy; BastionIT 2024
        </div>

        <ul class="flex flex-col lg:flex-row gap-4 mt-4 lg:mt-0">
          <li><a href="info/privacy" target="_blank" class="text-sm text-stone-500 hover:text-sky-500">Политика
              конфиденциальности</a></li>
        </ul>
      </div>
    </div>
  </footer>
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
        <ul class="mt-4">
          <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/news/index">Новости</a></li>
          <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/about">О нас</a></li>
          <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/how-we-work">Как мы
              работаем</a></li>
          <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/contact">Контакты</a></li>
          <li><a class="block hover:bg-sky-500 hover:text-white px-4 py-2" href="/pages/bastion-ek">Бастион ЭК</a></li>
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

          <a href="mailto:Info@bastionit.ru"
            class="block mt-4 font-bold text-lg hover:text-sky-500">info@bastionit.ru</a>

          <a href="#" class="btn flex w-full mt-4" x-data @click.prevent="$store.modals.open('callback')">
            Заказать звонок
          </a>
        </div>
      </div>
    </div>
  </div>

<?=OrdersFormWidget::widget([
  
])?>

  <!-- <div class="fixed w-full h-full z-50 top-0 left-0 bg-black bg-opacity-70 flex items-center justify-center"
    data-modal="request" x-cloak x-data x-transition.opacity x-show="$store.modals.find('request').active">
    <div class="p-8 bg-white rounded-lg w-[500px] relative" x-data @click.outside="$store.modals.close('request')">
      <button x-data="" @click="$store.modals.close('request')" aria-label="Close"
        class="absolute top-8 right-4 z-10 border-0 bg-transparent text-black" x-transition>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
      </button>

      <h3 class="text-3xl font-bold" x-text="$store.modals.find('request').data.modalTitle || 'Заказ в один клик'">Заказ
        в один клик</h3>
      <p class="mt-4 text-xs text-gray-500">Заполните форму и мы перезвоним вам в течение 10 минут</p>

      <div class="flex items-center mt-4"
        x-show="$store.modals.find('request').data.image || $store.modals.find('request').data.title">
        <div class="basis-1/4">
          <img src="" class="w-32 h-32 object-contain rounded-md p-2 border bg-white drop-shadow-md" alt=""
            :src="$store.modals.find('request').data.image">
        </div>
        <div class="basis-3/4 pl-4 ">
          <div class="font-bold text-lg" x-text="$store.modals.find('request').data.title"></div>
          <div class="mt-2 text-sm" x-text="$store.modals.find('request').data.price"></div>
        </div>
      </div>

      <form action="" class="mt-8" data-request="onLeadFormSubmit" data-request-success="this.reset()"
        data-request-flash data-modal-form>
        <input type="hidden" name="product" :value="$store.modals.find('request').data.title">

        <label for="name" class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="name" placeholder="Имя *"
            required>
        </label>

        <label for="name" class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="lastname" placeholder="Фамилия *"
            required>
        </label>
        <label for="phone_number" class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="phone_number"
            placeholder="Номер вашего телефона *" required>
        </label>
        <label class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="email" placeholder="E-mail *"
            required>
        </label>
        <label class="block mb-4">
          <textarea class="block w-full border-gray-400 rounded-lg p-4" name="comment"
            placeholder="Комментарий к заказу"></textarea>
        </label>
        <button class="btn" type="submit">Отправить заявку</button>

        <div class="mt-4 flex items-center">
          <input type="checkbox" name="privacy" id="privacy" required>
          <label class="block ml-2 text-sm text-gray-500" for="privacy">Соглашаюсь с <a class="text-sky-500"
              href="info/privacy" target="_blank">политикой конфиденциальности</a></label>
        </div>
      </form>
    </div>
  </div> -->

  <!-- <div class="fixed w-full h-full z-50 top-0 left-0 bg-black bg-opacity-70 flex items-center justify-center"
    data-modal="callback" x-cloak x-data x-transition.opacity x-show="$store.modals.find('callback').active">
    <div class="p-8 bg-white rounded-lg w-[500px] relative" x-data @click.outside="$store.modals.close('callback')">
      <button x-data="" @click="$store.modals.close('callback')" aria-label="Close"
        class="absolute top-8 right-4 z-10 border-0 bg-transparent text-black" x-transition>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
      </button>

      <h3 class="text-3xl font-bold" x-text="$store.modals.find('callback').data.modalTitle || 'Заказать звонок'">
        Заказать звонок</h3>
      <p class="mt-4 text-xs text-gray-500">Заполните форму и мы перезвоним вам в течение 10 минут</p>

      <form action="" class="mt-8" data-request="onLeadFormSubmit" data-request-success="this.reset()"
        data-request-flash data-modal-form>
        <label for="name" class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="name"
            placeholder="Как вас зовут? *" required>
        </label>
        <label for="phone_number" class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="phone_number"
            placeholder="Номер вашего телефона *" required>
        </label>
        <button class="btn" type="submit">Заказать звонок</button>

        <div class="mt-4 flex items-center">
          <input type="checkbox" name="privacy" id="privacy" required>
          <label class="block ml-2 text-sm text-gray-500" for="privacy">Соглашаюсь с <a class="text-sky-500"
              href="info/privacy" target="_blank">политикой конфиденциальности</a></label>
        </div>
      </form>
    </div>
  </div> -->

  <?=OrdersFormCallWidget::widget([
    
  ])?>

  <div
    class="fixed w-full h-full z-50 overflow-y-auto top-0 left-0 bg-black bg-opacity-70 flex items-start justify-center"
    data-modal="review" x-cloak x-data x-transition.opacity x-show="$store.modals.find('review').active">
    <div class="p-8 bg-white rounded-lg w-[500px] relative" x-data @click.outside="$store.modals.close('review')">
      <button x-data="" @click="$store.modals.close('review')" aria-label="Close"
        class="absolute top-8 right-4 z-10 border-0 bg-transparent text-black" x-transition>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
      </button>

      <h3 class="text-3xl font-bold">Оставить отзыв о товаре</h3>
      <p class="mt-4 text-xs text-gray-500"></p>

      <form action="" class="mt-8" data-request="onReviewSubmit" data-request-success="this.reset()" data-request-flash
        data-modal-form>
        <input type="hidden" name="product_id" value="">
        <label for="name" class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="customer_name"
            placeholder="Как вас зовут? *" required>
        </label>
        <label class="block mb-4">
          <input type="text" class="block w-full border-gray-400 rounded-lg p-4" name="email" placeholder="E-mail *"
            required>
        </label>
        <label class="block mb-4">
          <textarea class="block w-full border-gray-400 rounded-lg p-4" name="text" placeholder="Ваш отзыв о товаре "
            required></textarea>
        </label>
        <label class="block mb-4">
          <textarea class="block w-full border-gray-400 rounded-lg p-4" name="pros" placeholder="Плюсы"></textarea>
        </label>
        <label class="block mb-4">
          <textarea class="block w-full border-gray-400 rounded-lg p-4" name="cons" placeholder="Минусы"></textarea>
        </label>
        <label class="block mb-4">
          <label for="rate">Ваша оценка:</label>
          <select id="rate" class="block w-full border-gray-400 rounded-lg p-4" name="rate">
            <option value="5">5</option>
            <option value="4">4</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
          </select>
        </label>
        <button class="btn" type="submit">Отправить заявку</button>

        <div class="mt-4 flex items-center">
          <input type="checkbox" name="privacy" id="privacy" required>
          <label class="block ml-2 text-sm text-gray-500" for="privacy">Соглашаюсь с <a class="text-sky-500"
              href="info/privacy" target="_blank">политикой конфиденциальности</a></label>
        </div>
      </form>
    </div>
  </div>
  <script src="assets/js/manifest.js"></script>
  <script src="assets/js/vendor.min.js"></script>
  <script src="assets/js/main.min.js"></script>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>