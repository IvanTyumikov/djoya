<?php 
    $firstColor = 0;
    foreach ($product->getVariantsColorGroup() as $title => $variantsGroup){
        foreach ($product->getOptionsListForImagesRelation($variantsGroup) as $key => $value){
            $firstColor = $value['attribute_value'];
            break;
        }
    }
 ?>

<?php if($product->getVariantsColorGroup()): ?>
    <div class="product-info-color" data-action-images-color="<?= Yii::app()->createUrl('product/images-color'); ?>">
        <div class="product-info-color__tcolor">
            <span class="product-info-color__label">Цвет: </span>
            <?php foreach ($product->getVariantsColorGroup() as $title => $variantsGroup): ?>
                <?php $count = 0 ?>
                <?php foreach ($product->getOptionsListForImagesRelation($variantsGroup) as $key => $value): ?>
                    <?php $count++; ?>
                    <span class="product-info-color__value"><?= $value['attribute_value'] ?></span>
                    <?php break; ?>
                <?php endforeach ?>
            <?php endforeach; ?>
        </div>
        <div class="product-info-color__colors">
            <?php foreach ($product->getVariantsColorGroup() as $title => $variantsGroup): ?>
                <?php $count = 0 ?>
                <?php foreach ($product->getOptionsListForImagesRelation($variantsGroup) as $key => $value): ?>
                    <?php $count++; ?>
                    <span class="product-info-color__color js-product-info-color <?= $count == 1 ? 'active' : ''; ?> <?= $value['attribute_color'] == '#ffffff' ? 'product-info-color_white' : ''; ?>"
                        style="background: <?= $value['attribute_color'] ?>" 
                        data-attribute-value="<?= $value['attribute_value'] ?>"
                        data-product-id="<?= $product->id ?>"
                        data-variant-id="<?= $value['variant_id'] ?>"></span>
                <?php endforeach ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>