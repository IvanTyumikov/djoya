<?php $attributes = $product->getAttributeGroups(); ?>
<?php if($attributes) : ?>
    <div class="wg-product-info__attr wg-product-attr" id="product-list-attr">
        <?php foreach ($attributes as $groupName => $items): { ?>
            <?php foreach ($items as $key => $attribute): {
                $value = $product->attribute($attribute);
                if (empty($value)) continue;
            ?>
                <div class="wg-product-attr__list">
                    <span class="wg-product-attr__label-wrap">
                        <span class="wg-product-attr__label"><?= strip_tags(CHtml::encode($attribute->title)); ?></span>
                    </span>
                    <span class="wg-product-attr__val"><?= AttributeRender::renderValue($attribute, $product->attribute($attribute), '{item}'); ?></span>
                </div>
            <?php } endforeach; ?>
        <?php } endforeach; ?>
    </div>
<?php endif; ?>