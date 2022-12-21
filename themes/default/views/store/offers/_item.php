<div class="table-responsive">
    <table class="product-compare compare-table">
        <tr>
            <?php foreach ($products as $key => $product) : ?>
                <td>
                    <div class="product-compare__item" data-remove="<?= $product->id?>">
                        <a href="<?= Yii::app()->createUrl('/store/offers/remove', ['id' => $product->id]) ?>" class="product-compare__remove">
                            <i class="icon-close"></i>
                        </a>
                        <div class="product-compare__img">
                            <img src="<?= StoreImage::product($product); ?>" alt="" />
                        </div>
                        <div class="product-compare__info">
                            <div class="product-compare__name">
                                <span><?= $product->name ?></span>
                            </div>
                            <div class="product-compare__price compare-price">
                                <span class="compare-result"> <?= number_format($product->getResultPrice(), 0, '', ' '); ?></span>
                                <span class="ruble">руб.</span>
                            </div>
                        </div>
                    </div>
                </td>
            <?php endforeach ?>
        </tr>
        <tr>
        <?php foreach ($attr as $key => $attribute) : ?>
            <tr>
                <?php foreach ($products as $key => $product) : ?>
                <td>
                    <div class="product-compare-attribute">
                        <div class="product-compare-attribute__item">
                            <div class="product-compare-attribute__head"><?= $attribute['title'] ?></div>
                            <div class="product-compare-attribute__val">
                                <?php $val = $product->attributesValues(['condition'=>'attribute_id = '.$attribute['id']]); ?>
                                <?php //print_r($val[0]); ?>
                                <?php if (isset($val[0]) && $val[0]) : ?>
                                    <?php if ($attribute['type'] == AttributeStore::TYPE_SHORT_TEXT && $val[0]->string_value) : ?>
                                        <?php //= "test1";  ?>
                                        <div class="value value-yes" data-remove="<?= $product->id?>"><?= $val[0]->string_value ?> <?= $attribute['unit'] ?></div>

                                    <?php elseif ($attribute['type'] == AttributeStore::TYPE_NUMBER && $val[0]->number_value) : ?>
                                        <?php //= "test2";  ?>
                                        <div class="value value-yes" data-remove="<?= $product->id?>"><?= $val[0]->number_value ?> <?= $attribute['unit'] ?></div>

                                    <?php elseif ($attribute['type'] == AttributeStore::TYPE_CHECKBOX_LIST) : ?>
                                        <div class="value value-yes" data-remove="<?= $product->id?>">
                                            <?php foreach ($val[0]->optVals as $key => $opt) : ?>
                                                <?= $opt->value ?>
                                            <?php endforeach ?>
                                        </div>

                                    <?php elseif ($attribute['type'] == AttributeStore::TYPE_TEXT && $val[0]->text_value) : ?>
                                        <?php //= "test4";  ?>
                                        <div class="value value-yes" data-remove="<?= $product->id?>"><?= $val[0]->text_value ?> <?= $attribute['unit'] ?></div>

                                    <?php elseif ($attribute['type'] == AttributeStore::TYPE_DROPDOWN) : ?>
                                        <?php //= "test5";  ?>
                                        <div class="value value-yes" data-remove="<?= $product->id?>"><?php echo $val[0]->optVal->value; ?> <?php //= $attribute['unit'] ?></div>

                                    <?php else: ?>
                                        <div class="value value-not"></div>
                                    <?php endif ?>
                                <?php else: ?>
                                    <div class="value value-not"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
        </tr>
    </table>
</div>