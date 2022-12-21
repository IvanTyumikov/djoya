<?php
/**
 * @var $model CourierForm
 */
?>

<div class="delivery-address">
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'street', ['class' => 'control-label']) ?>
        <?= CHtml::activeTextField($model, 'street', ['class' => 'form-control']) ?>
        <?= CHtml::error($model, 'street', ['class' => 'help-block error']) ?>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'house', ['class' => 'control-label']) ?>
        <?= CHtml::activeTextField($model, 'house', ['class' => 'form-control']) ?>
        <?= CHtml::error($model, 'house', ['class' => 'help-block error']) ?>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'apartment', ['class' => 'control-label']) ?>
        <?= CHtml::activeTextField($model, 'apartment', ['class' => 'form-control']) ?>
        <?= CHtml::error($model, 'apartment', ['class' => 'help-block error']) ?>
    </div>
</div>