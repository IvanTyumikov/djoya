<?php
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'type' => 'vertical',
            'action' => ['/order/order/create'],
            'id' => 'order-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'clientOptions' => [
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType' => false,
                'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false); return !hasError;}',
            ],
            'htmlOptions' => [
                'hideErrorMessage' => false,
                'class' => 'order-form cart__form cart-form',
                'data-url-delivery-types' => Yii::app()->createUrl('/order/order/deliveryTypes'),
            ]
        ]
    ); ?>

<h3>Выберите способ оплаты:</h3>
<?php $payment = Payment::model()->findAll(); ?>
<?php if ($payment) : ?>
    <div class="payment-method">
        <ul class="payment-method__lists" id="payment-methods">
            <?php foreach ($payment as $payment) : ?>
                <li class="payment-method__list">
                    <input class="payment-method-radio" type="radio" name="Order[payment_method_id]"
                           value="<?= $payment->id; ?>" checked=""
                           id="payment-<?= $payment->id; ?>">
                    <label for="payment-<?= $payment->id; ?>">
                        <?= CHtml::encode($payment->name); ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<h3>Заполните поля ниже:</h3>
<div class="cart-form__order">
    <?= $form->hiddenField($order, 'sdek_id'); ?>
    <?= $form->textFieldGroup($order, 'family'); ?>
    <?= $form->textFieldGroup($order, 'name'); ?>
    <?= $form->textFieldGroup($order, 'email'); ?>
    <div class="form-group">
        <?= $form->labelEx($order, 'phone', ['class' => 'control-label']) ?>
        <?php $this->widget('CMaskedTextFieldPhone', [
                'model' => $order,
                'attribute' => 'phone',
                'mask' => '+7(999)999-99-99',
                'htmlOptions'=>[
                    'class' => 'data-mask form-control',
                    'data-mask' => 'phone',
                    'placeholder' => 'Телефон',
                    'autocomplete' => 'off'
                ]
            ]) ?>
        <?php echo $form->error($order, 'phone'); ?>
    </div>
    <?= $form->textFieldGroup($order, 'city',
    [
        'widgetOptions' => [
            'htmlOptions' => [
                'placeholder' => 'Введите город или населенный пункт',
            ]
        ] 
    ]); ?>
</div>

<div class="panel-order-form">
    <?= $form->hiddenField($order, 'zipcode'); ?>
    <?= $form->hiddenField($order, 'longitude'); ?>
    <?= $form->hiddenField($order, 'latitude'); ?>
    <?= $form->hiddenField($order, 'pvz_address'); ?>
    <?= $form->hiddenField($order, 'tariff_id'); ?>
    
    <div class="field-address hidden" id="field-address">
        <h3>Заполните адрес доставки:</h3>
        <?= $form->textFieldGroup($order, 'street'); ?>
        <?= $form->textFieldGroup($order, 'house'); ?>
        <?= $form->textFieldGroup($order, 'apartment'); ?>
    </div>

</div>

<?php $this->endWidget(); ?>