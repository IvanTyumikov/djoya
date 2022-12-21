<div id="callbackWriteUsModal" class="modal modal-write-us fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <noindex>
            <div class="modal-content">
                <div class="modal-write-us__wrap">
                    <div class="modal-write-us__form">
                        <div class="modal__header">
                            <div data-dismiss="modal" class="modal__close">
                                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/modal-close.svg'); ?>
                            </div>
                            <div class="modal__title">Написать нам</div>
                            <div class="modal__desc">
                                Оставьте свое обращение и наши специалисты 
                                свяжутся с вами в ближайшее время
                            </div>
                        </div>

                        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                            'id'=>'callback-write-us-form-modal',
                            'type' => 'vertical',
                            'htmlOptions' => ['class' => 'modal__form modal-form', 'data-type' => 'ajax-form'],
                        ]); ?>

                            <?php if (Yii::app()->user->hasFlash('callback-success')) : ?>
                                <script>
                                    // Срабатывает цель Яндекс.Метрики
                                    yaCounter<?= Yii::app()->getModule('yupe')->idYandexMetrika ?>.reachGoal('form');
                                    fbq('track', 'Lead');

                                    // Скрываю модальную форму
                                    $('#callbackWriteUsModal').modal('hide');

                                    // Вызываю модальное окно об успешной отправки формы
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
                                            $('#succes-mesage').parents(".overlay").removeClass("open");
                                        }, 350);
                                    }, 5000);
                                </script>
                            <?php endif ?>
                            
                            <div class="modal__body modal-form__body">
                                <?= $form->textFieldGroup($model, 'name', [
                                    'widgetOptions'=>[
                                        'htmlOptions'=>[
                                            'class' => '',
                                            'autocomplete' => 'off',
                                            'placeholder' => Yii::t('MailModule.mail', 'Имя'),
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

                                <div class="form-group form-group__textarea">
                                    <?= $form->textArea($model, 'body', [
                                        'placeholder' => 'Сообщение',
                                        'class' => ' form-control'      
                                    ]); ?>
                                </div>

                                <?= $form->hiddenField($model, 'verify'); ?>
                            </div>
                            <div class="form-captcha modal-form__captcha">
                                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
                                <?php $form->error($model, 'verifyCode'); ?>
                            </div>

                            <div class="modal-form__bot">
                                <div class="modal-form__but">
                                    <button class="button" id="callback-write-us-button" data-send="ajax">Отправить сообщение</button>
                                </div>
                                <div class="terms-of-use modal-form__terms">
                                    Нажимая кнопку Отправить сообщение 
                                    Вы соглашаетесь с <a target="_blank" href="/uploads/files/politic.docx">Условиями обработки персональных данных</a>
                                </div>
                            </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </noindex>
    </div>
</div>