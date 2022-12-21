<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id'=>'affiliate-form-form',
    'type' => 'vertical',
    'htmlOptions' => ['class' => 'modal__form modal-form', 'data-type' => 'ajax-form'],
]); ?>

    <div class="title">
        Выбирайте формат работы, который будет вам удобен:
    </div>

    <?php if (Yii::app()->user->hasFlash('callback-success')) : ?>
        <script>
            yaCounter<?= Yii::app()->params['metrika'] ?>.reachGoal('affiliateForm');

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
    
    <div class="affiliate-form-main">
        <div class="form-group form-group-radio">
            <?= $form->radioButtonList($model, 'radio', $model->getRadioLists(),
            [
                'template'=>'<span class="form-group-radio-item">{input}{label}</span>'
            ]); ?>
        </div>
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

        <?= $form->textFieldGroup($model, 'email', [
            'widgetOptions'=>[
                'htmlOptions'=>[
                    'class' => '',
                    'autocomplete' => 'off'
                ]
            ]
        ]); ?>


        <?= $form->textFieldGroup($model, 'city', [
            'widgetOptions'=>[
                'htmlOptions'=>[
                    'class' => '',
                    'autocomplete' => 'off'
                ]
            ]
        ]); ?>

        <?= $form->textFieldGroup($model, 'body', [
            'widgetOptions'=>[
                'htmlOptions'=>[
                    'class' => '',
                    'autocomplete' => 'off'
                ]
            ]
        ]); ?>

        <?= $form->hiddenField($model, 'verify'); ?>

        <!-- <div class="form-captcha modal-form__captcha">
            <div class="g-recaptcha" data-sitekey="<?php /*Yii::app()->params['key'];*/ ?>"></div>
            <?php /*$form->error($model, 'verifyCode');*/ ?>
        </div> -->

    </div>

    <button class="btn btn-green" id="affiliate-form-button" data-send="ajax">Отправить</button>
<?php $this->endWidget(); ?>