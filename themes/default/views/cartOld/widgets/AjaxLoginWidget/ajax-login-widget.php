<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id' => 'ajax-login',
    'action' => Yii::app()->createUrl('/cart/userAjax/ajaxLogin'),
    'htmlOptions' => [
        'class' => 'cart-form cart-form-login',
    ]
]) ?>

<?php if (Yii::app()->getUser()->hasFlash(yupe\widgets\YFlashMessages::SUCCESS_MESSAGE)) : ?>
    <div class="message-success">
        <?= Yii::app()->getUser()->getFlash(yupe\widgets\YFlashMessages::SUCCESS_MESSAGE) ?>
    </div>
    <script>
        $(".crtAuthorization-modal").find('.modal-footer').addClass('hidden');
        window.location = '<?= $redirect; ?>'
    </script>
<?php endif; ?>

<?= $form->errorSummary($model) ?>

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
    <div class="cart-form-login__but">
        <button type="submit" class="btn btn-green">Войти</button>
    </div>
    <div class="cart-form-login__recovery fl fl-ju-co-c">
        <?= CHtml::link('<span>Забыли пароль?</span>', ['/user/account/recovery'], [
            'class' => 'bt-cart-link'
        ]) ?>
    </div>

<?php $this->endWidget();
