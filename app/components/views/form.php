<div class="popup fixed w-full h-full z-50 top-0 left-0 bg-black bg-opacity-70 flex items-center justify-center"
    data-modal="request" x-cloak x-data x-transition.opacity x-show="$store.modals.find('request').active">

    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => ['order/send'],
        'options' => [
            'tabindex' => "-1",
            //'id' => 'formOrder',
            'data-action' => 'formorder',
          // 'accept-charset' => "windows-1251",
                ]
      ])?>


    <div class="popup__item p-8 bg-white rounded-lg w-[500px] relative" x-data @click.outside="$store.modals.close('request')">
      <button x-data="" @click="$store.modals.close('request')" aria-label="Close"
        class="absolute top-8 right-4 z-10 border-0 bg-transparent text-black" x-transition>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
      </button>
      <header class="popup__header">
        <h3 class="text-3xl font-bold" x-text="$store.modals.find('request').data.modalTitle || 'Заказ в один клик'">Заказ в один клик</h3>
        <p class="mt-4 text-xs text-gray-500">Заполните форму и мы перезвоним вам в течение 10 минут!</p>
      </header>
      <div class="popup__body mt-4 mb-4">
        <div class="flex items-center mb-4"
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
  
        <!-- < ?php $form = \yii\widgets\ActiveForm::begin([
          'action' => ['order/send'],
          'options' => [
                      'class' => 'mt-4',
                      'tabindex' => "-1",
                      //'id' => 'formOrder',
                      'data-action' => 'formorder',
                    // 'accept-charset' => "windows-1251",
                          ]
        ])?> -->
  
        <label class="block mb-4">
                      <?=$form->field($order, 'name', ['template' => "{input}"])->textInput([
                    'class' => 'block w-full border-gray-400 rounded-lg',
                  // 'tabindex' => '1',
                    'placeholder' => 'Как Вас зовут?',
                          ])?>
  
        </label>
  
        <label class="block mb-4">
                      <?=$form->field($order, 'phone', ['template' => "{input}"])->textInput([
                    'class' => 'block w-full border-gray-400 rounded-lg',
                  //  'tabindex' => '2',
                    'placeholder' => 'Номер вашего телефона',
                          ])?>
        </label>
  
        <label class="block mb-4">
                      <?=$form->field($order, 'email', ['template' => "{input}"])->textInput([
                    'class' => 'block w-full border-gray-400 rounded-lg',
                  //  'tabindex' => '2',
                    'placeholder' => 'Email',
                          ])?>
        </label>
        
        <div x-data="{ fileName: 'Файл не выбран' }" class="block mb-4">
          <?= $form->field($order, 'file')->fileInput([
              'class' => 'hidden', 
              '@change' => 'fileName = $event.target.files[0]?.name || "Файл не выбран"',
              'x-ref' => 'fileInput'
          ])->label(false); ?>

          <label @click="$refs.fileInput.click()" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition btn ">
          Загрузить BOM
          </label>
          <span x-text="fileName" class="ml-2 text-gray-700"></span>
      </div>

        <?= $form->field($order, 'prod_id')->hiddenInput([
            'value' => '', 
            'x-bind:value' => '$store.modals.find("request").data.productId'
        ])->label(false); ?>      
  
        <label class="block">         
                    <?=$form->field($order, 'message', ['template' => "{input}"])->textarea(['rows' => 3, 'class' => 'block w-full border-gray-400 rounded-lg', 'placeholder'=>"Комментарий к заказу", 'tabindex'=>"3"])?>
        </label>


      </div>
      <footer class="popup__footer">
        <div class="mb-20">Нажимая кнопку, я даю согласие на <b>обработку персональных данных</b></div>
        <!-- <button type="submit" class="btn btn--size-lg btn--arrow" tabindex="4" data-popup-btn>Отправить сообщение</button> -->

        <button type="submit" class="btn btn--size-lg btn--arrow form-button" tabindex="4" data-popup-btn>Заказать звонок</button>
  
        <?php \yii\widgets\ActiveForm::end();?>
      </footer>
    </div>
  </div>