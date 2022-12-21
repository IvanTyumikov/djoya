<div id="callbackModalPresent" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal__header">
                <div data-dismiss="modal" class="modal__close">
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/modal-close.svg'); ?>
                </div>
                <div class="modal__title">Получить <br> презентацию</div>
                <div class="modal__desc">Оставьте заявку<br> и мы Вам перезвоним!</div>
            </div>

            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                'id'=>'callback-modal-form-present',
                'type' => 'vertical',
                'htmlOptions' => ['class' => 'modal__form modal-form', 'data-type' => 'ajax-form'],
            ]); ?>

                <?php if (Yii::app()->user->hasFlash('callback-success')) : ?>
                    <script>
                        // Срабатывает цель Яндекс.Метрики
                        yaCounter<?= Yii::app()->getModule('yupe')->idYandexMetrika ?>.reachGoal('form');
                        fbq('track', 'Lead');
                
                        $('#callbackModalPresent').modal('hide');

                        $(".message-modal").each( function(){
                            $(this).wrap('<div class="overlay"></div>')
                        });

                        $('#succes-mesage').parents(".overlay").addClass("open");
                        setTimeout( function(){
                            $('#succes-mesage').removeClass('hidden');
                            setTimeout(function () {
                              $('#succes-mesage').addClass("open");
                          }, 20);
                        }, 350);

                        setTimeout(function(){
                            $('#succes-mesage').removeClass("open");
                            setTimeout( function(){
                                $('.message-modal').unwrap('.overlay');
                                $('#succes-mesage').addClass('hidden');
                                $('#succes-mesage').parents(".overlay").removeClass("open");
                            }, 350);
                        }, 5000);
                    </script>
                <?php endif ?>
                
                <div class="modal__body modal-form__body">
                    <?= $form->hiddenField($model, 'title', ['value' => 'Получить презентацию']); ?>

                    <?= $form->textFieldGroup($model, 'name', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'class' => '',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>

                    <?= $form->telFieldGroup($model, 'phone', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'class' => 'phone-mask',
                                'data-phoneMask' => 'phone',
                                'placeholder' => 'Телефон',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>

                    <?= $form->hiddenField($model, 'verify'); ?>

                    <div class="form-captcha modal-form__captcha">
                        <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
                        <?php $form->error($model, 'verifyCode'); ?>
                    </div>

                    <div class="modal-form__bot">
                        <div class="modal-form__but">
                            <button class="button" id="callback-modal-button-present" data-send="ajax">Отправить</button>
                        </div>
                    </div>
                     <div class="terms-of-use modal-form__terms">
                            * Оставляя заявку вы соглашаетесь с <a target="_blank" href="/uploads/files/politic.docx">Условиями обработки персональных данных</a>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>