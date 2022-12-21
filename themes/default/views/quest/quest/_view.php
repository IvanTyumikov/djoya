<div class="quest__item quest-item <?= $data->id == 1 ? 'active' : '' ?>" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <div class="quest-item__head">
        <div class="quest-item__title" itemprop="name">
            <?= $data->name ?>
        </div>
        <div class="quest-item__icon">
            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/plus.svg'); ?>
        </div>
    </div>
    <div class="quest-item__body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div itemprop="text">
            <?= $data->body ?>
        </div>
    </div>
</div>