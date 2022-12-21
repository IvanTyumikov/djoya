<?php $id = 0; ?>
<?php foreach ($product->getVariantsGroup() as $title => $variantsGroup): { ?>
    <?php $id++; ?>
    <div class="product-side__label"><?= $title ?></div>
    <div class="product-variant js-product-variant id-<?= $product->id ?>">
        <?php 

            $listArray = [];
            foreach ($variantsGroup as $key => $value) {
                $listArray += [
                    $value->id => [
                        'amount' => $value->amount,
                        'attribute_value' => $value->attribute_value,
                        'unit' => $value->attribute->unit,
                    ]
                ];
            }
        ?>
        <?php $listData = CHtml::listData($variantsGroup, 'id', 'optionValue'); ?>

        <span class="product-variant__value">
            <span class="value"><?= $listData[current(array_keys($listData))] ?></span>
            <span class="icon">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/dropdown.svg'); ?>
            </span>
        </span>

        <div class='product-variant__main'>
            <?= MyHtml::radioButtonList(
                "ProductVariant[]-{$id}-{$product->id}",
                current(array_keys($listData)),
                $listArray,
                [
                    'itemOptions' => $product->getVariantsOptions(),
                    'container' => '',
                    'separator' => '',
                    'template' => "
                        <div class=\"js-variant-price product-variant__col id-col-{$product->id}\">
                            {input}
                            {label}
                        </div>
                    "
                ]
            ); ?>
        </div>
    </div>
<?php } endforeach; ?>

<?php $id = $id+1; ?>
<?php foreach ($product->getVariantsColorGroup() as $variantsGroup): ?>
    <?php if($product->getOptionsListForImagesRelation($variantsGroup)): ?>
        <div class="product-variant-color js-product-variant-color hidden">
            <?= MyHtml::radioButtonList(
                "ProductVariant[]-{$id}-{$product->id}",
                current(array_keys($product->getOptionsListForImagesRelation($variantsGroup))),
                $product->getOptionsListForImagesRelation($variantsGroup),
                [
                    'itemOptions' => $product->getVariantsOptions(),
                    'container' => '',
                    'separator' => '',
                    'template' => "
                            <div class=\"product-variant__col id-col-{$product->id}\">
                                {input}
                                {label}
                            </div>
                        "
                ]
            ); ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
