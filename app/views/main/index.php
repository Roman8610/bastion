<?php

use app\components\IconsBlockMainWidget;
use yii\helpers\Url;
?>
<section class="request mt-4 lg:mt-8">
            <div class="h-[220px] relative rounded-md">
              <img src="images/blocks/request/bg.jpg" alt=""
                class="w-full h-full object-cover rounded-md">
              <div
                class="absolute w-full h-full top-0 left-0 z-10 bg-black bg-opacity-70 flex flex-col justify-center px-8 py-8 lg:py-0 rounded-md">
                <div class="text-white font-bold text-xl lg:text-3xl">Не нашли нужный компонент?</div>
                <div class="text-white text-sm lg:text-xl mt-4">Просто закажите его у нас!</div>
                <div class="mt-8 self-start flex flex-col lg:flex-row items-start lg:items-center gap-4">
                  <button class="btn self-start" x-data="modalTrigger('request')" x-bind="trigger"
                    data-info='{"modalTitle":"Заказать компонент"}'>Нажмите сюда</button>
                  <span class="hidden lg:inline-flex text-white font-light">или напишите</span>
                  <a href="mailto:info@bastionit.ru"
                    class="hidden lg:inline-flex text-white hover:text-sky-500 text-xl font-bold">info@bastionit.ru</a>
                </div>
              </div>
            </div>
          </section>
          <?=IconsBlockMainWidget::widget([]);?>

          <section class="content mt-8">
            <div class="flex flex-wrap">
              <div class="basis-full mt-4 lg:mt-0">
                <h2 class="font-bold text-2xl">Производители</h2>
                <div class="mt-4 mb-4 grid lg:grid-cols-8 grid-cols-4 gap-4">
                  <img src="images/65bcbf16f0bf4070174536.jpeg" alt="">
                  <img src="images/65bcbf171596f230957053.jpeg" alt="">
                  <img src="images/65bcbf1724638208731964.jpeg" alt="">
                  <img src="images/65bcbf1751c3e136479673.jpeg" alt="">
                  <img src="images/65bcbf174fded912216643.jpeg" alt="">
                  <img src="images/65bcbf1772076102867343.jpeg" alt="">
                  <img src="images/65bcbf177cae3359968256.jpeg" alt="">
                  <img src="images/65bcbf17946ca246586464.jpeg" alt="">
                </div>
                <!-- <a href="/manufactures" style="text-decoration:underline" class="mt-4"> Все производители </a> -->
              </div>

              <!-- <div class="basis-full mt-8">
                <div x-data="{ expanded: false }">
                  <article class="prose relative" :class="expanded ? '':'white-overlay'" x-show="expanded"
                    x-collapse.min.400px>
                    <h2>Как мы работаем</h2>

                    <p style="text-align: justify;">Вы можете оформить заказ продукции в нашем интернет-магазине или
                      отправить нам список всех интересующих вас позиций. Запрос может быть выполнен в любой форме:
                      звонок по телефону, отправка письма на e-mail или заполнение специальной формы на сайте. У нас
                      есть широкий ассортимент электронных комплектующих со стоков из России, Европы, США и Азии, а
                      также возможность заказать электронику со складов наших зарубежных партнеров. Обрабатываем список
                      комплектующих до 300 позиций и создаем коммерческое предложение и счета на оплату в режиме онлайн.
                    </p>
                    <h4 style="text-align: justify;"><strong>Проверяем техническую спецификацию и заносим данные в
                        CRM</strong></h4>
                    <p style="text-align: justify;">Перед тем, как принять в работу ваш запрос, мы тщательно проверим
                      партномер по каждому товару, указанному в запросе, с помощью datasheet (технической спецификации).
                    </p>
                    <p style="text-align: justify;">В нашей работе все данные заносятся в удобную, надежную CRM-систему,
                      что позволяет более быстро и просто обрабатывать заказы и минимизировать возможные ошибки.</p>
                    <h4><strong>Подготавливаем коммерческое предложение и оговариваем все условия</strong></h4>
                    <p style="text-align: justify;">Наш сотрудник подготовит для вас коммерческое предложение на
                      специальном бланке в формате XLS (Excel). Если вы будете делать заказ через интернет-магазин,
                      коммерческое предложение автоматически сформируется, и вы сможете экспортировать его в формате
                      Excel.</p>
                    <p style="text-align: justify;">1. В беседе с нашим менеджером у вас будет возможность задать все
                      интересующие вопросы по условиям оплаты, срокам и гарантии, чтобы оговорить все условия поставки.
                    </p>
                    <p style="text-align: justify;">2. Мы отправляем вам счет в формате PDF на ваш e-mail, выставляя
                      счет на оплату. Соответственно, в нашем интернет-магазине счет на оплату создается автоматически.
                    </p>
                    <p style="text-align: justify;">3. После того, как счет будем вами оплачен, сотрудники отдела
                      закупок разместят заказ у зарубежных партнеров.</p>
                    <p style="text-align: justify;">4. Отсчет времени доставки продукции стартует с того момента, когда
                      деньги поступят на счет.</p>
                    <p style="text-align: justify;">При размещении заказа в режиме онлайн вы имеете возможность
                      отслеживать статус выполнения и прочую информацию. Например, платежи по счетам, перемещение
                      комплектующих в процессе поставки и прохождение входного контроля. Заказ поступает на
                      консолидационный склад, где производится первая приёмка комплектующих нашими сотрудниками за
                      границей. Если при проверке выявятся дефекты, менеджер свяжется с вами для принятия решений. Затем
                      оформляется на таможне, где мы уплачиваем все таможенные пошлины, налоги и можем оформить
                      сертификат на ввезенный товар.</p>
                    <h4><strong>Входной контроль</strong></h4>
                    <p style="text-align: justify;">Проводим стопроцентный контроль ввозимых из-за рубежа электронных
                      комплектующих по внешним признакам. Благодаря такому подходу заказчик может быть уверен в том, что
                      получит необходимый ему товар с учетом года выпуска, одной партии (при договоренности) и других
                      условий.</p>
                    <h4><strong>Упаковываем и отправляем заказчику</strong></h4>
                    <p style="text-align: justify;">Всегда тщательным образом уделяем внимание упаковке товара и
                      используем в наших складских помещениях антистатические покрытия. Это крайне важно, так как
                      непосредственно оказывает влияние на работоспособность электронных изделий. Повреждение
                      статическим электричеством может вызвать сбои при дальнейшей эксплуатации электроники или полную
                      потерю работоспособности.</p>
                    <p style="text-align: justify;">Продукция, зарекомендовавшая себя на рынке услуг, отправляется
                      заказчику с наших складов. Она упаковывается в специальные металлизированные пакеты с
                      антистатическими свойствами и поглотителями влаги. Для доставки мы используем услуги курьерской
                      компании. Если у вас есть особые требования относительно доставки, просим сообщить нам.</p>
                  </article>
                  <div class="mt-4"><a href="#" @click.prevent="expanded = !expanded"
                      class="text-sky-500 underline decoration-dotted"
                      x-text="expanded ? 'Свернуть':'Показать всё'">Показать всё</a></div>
                </div>
              </div> -->

            </div>
          </section>