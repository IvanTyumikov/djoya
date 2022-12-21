<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id' => 'ajax-registration',
    'action' => Yii::app()->createUrl('/cart/userAjax/ajaxRegistration'),
    'htmlOptions' => [
        'class' => 'cart-form cart-form-reg',
    ]
]) ?>

<?php if (Yii::app()->getUser()->hasFlash(yupe\widgets\YFlashMessages::ERROR_MESSAGE)) : ?>
    <div class="alert alert-danger">
        <?= Yii::app()->getUser()->getFlash(yupe\widgets\YFlashMessages::ERROR_MESSAGE) ?>
    </div>
<?php endif ?>

<?php if (Yii::app()->getUser()->hasFlash(yupe\widgets\YFlashMessages::SUCCESS_MESSAGE)) : ?>
    <div class="message-success">
        <?= Yii::app()->getUser()->getFlash(yupe\widgets\YFlashMessages::SUCCESS_MESSAGE) ?>
    </div>
    <script>
        $(".crtAuthorization-modal").find('.modal-footer').addClass('hidden');
        window.location = '<?= $redirect; ?>'
    </script>

<?php endif ?>
<?php //= $form->errorSummary($model) ?>

<?= $form->telFieldGroup($model, 'phone', [
    'widgetOptions' => [
        'htmlOptions' => [
            'class' => 'phone-mask',
            'data-phoneMask' => 'phone',
            'placeholder' => Yii::t('default', 'Телефон'),
            'autocomplete' => 'off'
        ]
    ]
]); ?>
<?= $form->textFieldGroup($model, 'email') ?>

<?= $form->passwordFieldGroup($model, 'password', [
    'groupOptions' => [
        'class' => 'password-form-group',
    ],
    'appendOptions' => [
        'class' => 'password-input-show',
    ],
    'append' => '<i class="fa fa-eye" aria-hidden="true"></i>'
]); ?>

<?= $form->passwordFieldGroup($model, 'cPassword', [
    'groupOptions' => [
        'class' => 'password-form-group',
    ],
    'appendOptions' => [
        'class' => 'password-input-show',
    ],
    'append' => '<i class="fa fa-eye" aria-hidden="true"></i>'
]); ?>

    <div class="policy-checkbox">
        <?= $form->checkBox($model, 'check') ?>
        <label for="RegistrationForm_check">
            Согласен с <a target="_blank"
                          href="<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['id' => 4]); ?>">
                Условиями обработки персональных данных </a>
        </label>
        <?php //= $form->labelEx($model, 'check') ?>
        <?= $form->error($model, 'check') ?>
    </div>

    <div class="cart-form-reg__but">
        <button type="submit" class="btn btn-green">Зарегистрироваться</button>
    </div>
<?php $this->endWidget();
