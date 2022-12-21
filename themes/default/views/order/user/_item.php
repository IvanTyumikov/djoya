<div class="lk-order__item">
    <div class="lk-order__column lk-order__column-date">
        <span><?= Yii::t("OrderModule.order", "Date");?>: </span>
        <?= date('d.m.Y в H:i', strtotime($data->date)); ?>
    </div>
    <div class="lk-order__column lk-order__column-name">
        <span><?= Yii::t("OrderModule.order", "Order #");?>: </span>
        <?= CHtml::link(
            Yii::t('OrderModule.order', 'Order #{n}', [$data->id]),
            ['/order/order/view', 'url' => $data->url],
            ['class' => 'cart-item__link']
        ) . ($data->paid ? ' - ' . $data->getPaidStatus() : ''); ?>
    </div>
    <div class="lk-order__column">
        <span><?= Yii::t("OrderModule.order", "Status");?>: </span>
        <?= CHtml::encode($data->getStatusTitle()); ?>
    </div>
</div>