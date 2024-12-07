<div class="fixed w-full h-full z-50 top-0 left-0 bg-black bg-opacity-70 flex items-center justify-center"
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
      <p class="mt-4 text-xs text-gray-500">Заполните форму и мы перезвоним вам в течение 10 минут!</p>

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

      <!-- <form action="" class="mt-8" data-request="onLeadFormSubmit" data-request-success="this.reset()"
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
      </form> -->






      <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => ['order/send'],
        'options' => [
                    'class' => 'mt-8',
                    'tabindex' => "-1",
                   // 'accept-charset' => "windows-1251",
                        ]
    ])?>

<label class="block mb-4">
               <?=$form->field($order, 'name', ['template' => "{input}"])->textInput([
            'class' => 'block w-full border-gray-400 rounded-lg p-4',
           // 'tabindex' => '1',
            'placeholder' => 'Имя',
                  ])?>

</label>

<label class="block mb-4">
               <?=$form->field($order, 'last_name', ['template' => "{input}"])->textInput([
            'class' => 'block w-full border-gray-400 rounded-lg p-4',
           // 'tabindex' => '1',
            'placeholder' => 'Фамилия',
                  ])?>

</label>

<label class="block mb-4">
              <?=$form->field($order, 'phone', ['template' => "{input}"])->textInput([
            'class' => 'block w-full border-gray-400 rounded-lg p-4',
          //  'tabindex' => '2',
            'placeholder' => 'Номер вашего телефона',
                  ])?>
</label>

<label class="block mb-4">
              <?=$form->field($order, 'email', ['template' => "{input}"])->textInput([
            'class' => 'block w-full border-gray-400 rounded-lg p-4',
          //  'tabindex' => '2',
            'placeholder' => 'Email',
                  ])?>
</label>

<label class="block mb-4">         
            <?=$form->field($order, 'message', ['template' => "{input}"])->textarea(['rows' => 5, 'class' => 'block w-full border-gray-400 rounded-lg p-4', 'placeholder'=>"Комментарий к заказу", 'tabindex'=>"3"])?>
</label>

            <div class="mb-20">Нажимая кнопку, я даю согласие на <b>обработку персональных данных</b></div>
            <button type="submit" class="btn btn--size-lg btn--arrow" tabindex="4" data-popup-btn>Отправить сообщение</button>
        
    
    <?php \yii\widgets\ActiveForm::end();?>

    </div>
  </div>