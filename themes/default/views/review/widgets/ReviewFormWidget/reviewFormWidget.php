<?php Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js', CClientScript::POS_END); ?>
<div class="review-form__main review-form-box">
    <div class="review-form-box__form">
        <?php Yii::app()->user->returnUrl = Yii::app()->request->requestUri;
            $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm', [
                    'id'          => 'review-form',
                    'type'        => 'vertical',
                    'htmlOptions' => [
                        'class' => 'form-my form-modal js-form-file', 
                        'data-type' => 'ajax-form',
                        'enctype' => 'multipart/form-data'
                    ],    
                ]
            ); ?>
                <?php /*= $form->hiddenField($model, 'rating'); */?><!--

                <div class="raiting-form">
                    <div class="raiting-form__list raiting-list raiting-list-form">
                        <div class="raiting-list__item" data-id="1" data-text="Ужасно"></div>
                        <div class="raiting-list__item" data-id="2" data-text="Плохо"></div>
                        <div class="raiting-list__item" data-id="3" data-text="Сойдет"></div>
                        <div class="raiting-list__item" data-id="4" data-text="Хорошо"></div>
                        <div class="raiting-list__item" data-id="5" data-text="Отлично"></div>
                    </div>
                    <div class="raiting-form__value">
                        <span class="raiting-form__value-label">Ваша оценка: </span>
                        <span class="raiting-form__value-val" id="js-raiting-val-text">Хорошо</span>
                    </div>
                </div>

                --><?php /*= $form->error($model, 'rating');*/?>

                <div class="review-order__label"><?= $model->getAttributeLabel('order') ?></div>
                <div class="review-order">
                    <div class="review-order__field">
                        <?= $form->textFieldGroup($model, 'order', [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'data-original-title' => $model->getAttributeLabel('order'),
                                    'data-content'        => $model->getAttributeDescription('order'),
                                    'autocomplete' => 'off',
                                ],
                            ],
                        ]); ?>
                    </div>
                    <div class="review-order__desc">
                        Обращаем ваше внимание, что номер заказа не будет отображен в отзыве. <br>
                        Это необходимо для сбора статистики и информации по заказам.
                    </div>
                </div>

                <div class="review-form-warning">
                    <div class="review-form-warning__label">Мы ожидаем от вас честный отзыв</div>
                    <div class="review-form-warning__label2">Отзыв не пройдет модерацию, если:</div>
                    <div class="review-form-warning__list">
                        Использованы нецензурные выражения, оскорбления и угрозы<br>
                        Указаны адреса, телефоны и ссылки, содержащие прямую рекламу<br>
                        В отзыве фигурирует цена товара и её изменение<br>
                        Отзыв не относится к теме
                    </div>
                </div>

                <?= $form->textFieldGroup($model, 'username', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'data-original-title' => $model->getAttributeLabel('username'),
                            'data-content'        => $model->getAttributeDescription('username'),
                            'autocomplete' => 'off'
                        ],
                    ],
                ]); ?>

                <?= $form->textAreaGroup($model, 'text', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'data-original-title' => $model->getAttributeLabel('text'),
                            'data-content'        => $model->getAttributeDescription('text'),
                            'autocomplete' => 'off'
                        ],
                    ],
                ]); ?>

                <div class="file-upload__label">Прикрепите фотографии</div>
                <div class="file-upload" id="file-upload">
                    <?php echo CHtml::fileField("ReviewImage[][image]",'', ['multiple'=>true]); ?>
                    <div class="file-upload__icon">
                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/photos.svg'); ?>
                    </div>
                    <div class="file-upload__text" id="file-upload-text">
                        <label for="ReviewImage_image">Выберете файлы</label>
                        <span> или перетащите их сюда</span>
                    </div> 
                </div>

                <!-- <div class="form-bot">
                    <div class="form-captcha">
                        <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                        </div>
                        <?= $form->error($model, 'verifyCode');?>
                    </div>
                </div> -->

                <div class="form-button">
                    <button class="review-form__send btn btn-green" id="reviewZayavka-button" data-send="ajax">Отправить отзыв</button>
                    <div class="form-button__desc form-terms">
                        Нажимая кнопку “Отправить отзыв”, вы соглашаетесь <br>
                        с <a href="/uploads/files/politic.docx">политикой обработки персональных данных</a>
                    </div>
                </div>

                <?php if (Yii::app()->user->hasFlash('review-success')): ?>
                    <div id="reviewModal" class="modal fade" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div data-dismiss="modal" class="modal__close">
                                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/modal-close.svg'); ?>
                                    </div>
                                    <div class="box-style__header">
                                        <div class="box-style__heading">
                                            Уведомление
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-success-message">
                                        Ваша отзыв успешно отправлен. После модерации он появится на сайте!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $('#reviewModal').modal('show');
                        setTimeout(function(){
                            $('#reviewModal').modal('hide');
                        }, 5000);
                    </script>
                <?php endif ?>
        <?php $this->endWidget(); ?>
    </div>
</div>