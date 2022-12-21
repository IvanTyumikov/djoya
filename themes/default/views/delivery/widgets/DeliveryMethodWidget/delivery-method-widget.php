<?= $deliveryType->getDeliveryForm($order); ?>

<div class="payments-section">
	<h4>Способ оплаты</h4>
	<ul class="payment-methods">
		<?php foreach ($deliveryType->paymentMethods as $payment) :  ?>
		    <li class="payment-method__item">
		    	<div class="payment-rich-radio">
			        <input class="payment-method-radio" type="radio" name="Order[payment_method_id]" value="<?= $payment->id; ?>" checked="" id="payment-<?= $payment->id; ?>">
			        <label for="payment-<?= $payment->id; ?>">
			            <?= CHtml::encode($payment->name); ?>
			        </label>
			        <?php if ($payment->description) : ?>
	                    <div class="rich-radio-body__text">
	                        <?= $payment->description; ?>
	                    </div>
	                <?php endif; ?>
			    </div>
		    </li>
		<?php endforeach; ?>
	</ul>
</div>

<?= CHtml::activeLabel($order, 'comment') ?>
<?= CHtml::activeTextArea($order, 'comment', ['class' => 'form-control']) ?>
