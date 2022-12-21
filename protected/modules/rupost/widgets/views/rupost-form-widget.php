<div class="delivery-address">
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'zipcode', ['class' => 'control-label']) ?>
        <?php $disClass = $model->zipcode ? 'input-disabled' : '' ?>
        <?= CHtml::activeTextField($model, 'zipcode', ['class' => 'form-control '.$disClass]) ?>
        <?= CHtml::error($model, 'zipcode', ['class' => 'help-block error']) ?>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'region', ['class' => 'control-label']) ?>
        <?php $disClass = $model->region ? 'input-disabled' : '' ?>
        <?= CHtml::activeTextField($model, 'region', ['class' => 'form-control '.$disClass]) ?>
        <?= CHtml::error($model, 'region', ['class' => 'help-block error']) ?>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'city', ['class' => 'control-label']) ?>
        <?php $disClass = $model->city ? 'input-disabled' : '' ?>
        <?= CHtml::activeTextField($model, 'city', ['class' => 'form-control '.$disClass]) ?>
        <?= CHtml::error($model, 'city', ['class' => 'help-block error']) ?>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'street', ['class' => 'control-label']) ?>
        <?php $disClass = $model->street ? 'input-disabled' : '' ?>
        <?= CHtml::activeTextField($model, 'street', ['class' => 'form-control '.$disClass]) ?>
        <?= CHtml::error($model, 'street', ['class' => 'help-block error']) ?>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'house', ['class' => 'control-label']) ?>
        <?php $disClass = $model->house ? 'input-disabled' : '' ?>
        <?= CHtml::activeTextField($model, 'house', ['class' => 'form-control '.$disClass]) ?>
        <?= CHtml::error($model, 'house', ['class' => 'help-block error']) ?>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabelEx($model, 'apartment', ['class' => 'control-label']) ?>
        <?php $disClass = $model->apartment ? 'input-disabled' : '' ?>
        <?= CHtml::activeTextField($model, 'apartment', ['class' => 'form-control '.$disClass]) ?>
        <?= CHtml::error($model, 'apartment', ['class' => 'help-block error']) ?>
    </div>
</div>