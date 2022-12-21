<?php if(!empty($categories)):?>
    <div class="filter-block filter-block-category">
        <div class="filter-block__header">
            <?php /*file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/filter-open.svg');*/ ?>
            <span><?= Yii::t('StoreModule.store', 'Categories') ?></span>
        </div>
        <div class="filter-block__body filter-block__category">
            <ul class="filter-block__list category-list-filter">
                <?php $count = 1; ?>
                <?php foreach($categories as $category):?>
                    <li class="filter-block__item category-list-filter__item filter-list <?= ($count <= 5) ? '' : 'hidden'; ?>">
                        <a class="box-animation" href="<?= $category->getCategoryUrl(); ?>">
                            <?php /*strip_tags($category->name_short);*/ ?>
                        </a>
                    </li>
                    <?php $count++; ?>
                <?php endforeach;?>
            </ul>
            <?php if($count > 6) : ?>
                <div class="filter-block__footer">
                    <a class="filter-block__more but-more" href="#">
                        <span data-text="Скрыть">Показать еще (<?= $count - 6; ?>)</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif;?>
