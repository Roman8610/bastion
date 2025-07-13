<div class="fixed w-full h-full z-50 top-0 left-0 bg-black bg-opacity-70 flex items-center justify-center"
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

              <?php $form = \yii\widgets\ActiveForm::begin([
                      'action' => ['order-call/send'],
                      'options' => [
                                  'class' => 'mt-8',
                                  //'id' => 'formCall',
                                  'data-action' => 'formcall',
                                  'tabindex' => "-1",
                                // 'accept-charset' => "windows-1251",
                                      ]
                  ])?>

              <label class="block mb-4">
                            <?=$form->field($order, 'name', ['template' => "{input}"])->textInput([
                          'class' => 'block w-full border-gray-400 rounded-lg p-4',
                        // 'tabindex' => '1',
                          'placeholder' => 'Как вас зовут? *',
                                ])?>

              </label>


              <label class="block mb-4">
                            <?=$form->field($order, 'phone', ['template' => "{input}"])->textInput([
                          'class' => 'block w-full border-gray-400 rounded-lg p-4',
                        //  'tabindex' => '2',
                          'placeholder' => 'Номер вашего телефона *',
                                ])?>
              </label>

              <div class="mb-20">Нажимая кнопку, я даю согласие на <b>обработку персональных данных</b></div>
                          <!-- <button type="submit" class="btn btn--size-lg btn--arrow" tabindex="4" data-popup-btn>Заказать звонок</button> -->

              <button type="submit" class="btn btn--size-lg btn--arrow form-button">Заказать звонок</button>
                      
                  
              <?php \yii\widgets\ActiveForm::end();?>


    </div>
  </div>
