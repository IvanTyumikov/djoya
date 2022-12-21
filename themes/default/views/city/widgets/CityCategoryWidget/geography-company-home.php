<?php if ($models) : ?>
    <?php $search = ''; ?>
    <?php if (isset($_GET['geography-city-search'])) : ?>
        <?php $search = $_GET['geography-city-search']; ?>
    <?php endif; ?>

    <div class="geography-company-home">
        <div class="content">
            <div class="box-style fl fl-wr-w fl-al-it-fl-e">
                <div class="box-style__header">
                    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
                        'id' => 10
                    ]); ?>
                </div>
                <div class="box-style__content">
                    <div class="geography-city-form fl fl-wr-w">
                        <form id="geography-city-form" class="fl" action="">
                            <div class="geography-form__input">
                                <div class="form-group">
                                    <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', [
                                        'name'=>'geography-city-search',
                                        'source'=> current($models)->getCityList(),
                                        'options'=>[
                                            'minLength'=>'2',
                                        ],
                                        'htmlOptions'=>[
                                            'placeholder' => 'Найдите свой город'
                                        ],
                                    ]); ?>
                                </div>
                            </div>
                            <div class="geography-form__button">
                                <button class="but but-black" type="submit">Найти</button>
                            </div>
                        </form>
                        <a class="geography-city-form__all but but-svg but-svg-right but-svg-animation-plus" href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'filialy']) ?>">
                            <span>Все города</span>
                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/plus.svg'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="geography-company-section js-geography-company">
                <?php foreach ($models as $key => $category) : ?>
                    <div class="geography-company-section__item fl fl-wr-w fl-ju-co-sp-b">
                        <div class="geography-company-section__info">
                            <div class="geography-company-section__name">
                                <?= $category->name_short; ?>
                            </div>
                            <div class="geography-company-section__img box-style-img">
                                <?= CHtml::image('', '', [
                                    'class' => 'js-load-img',
                                    'data-img-sm' => $category->getImageUrl(),
                                    'data-img-xs' => $category->getImageUrl(1, 1, false),
                                ]); ?>
                            </div>
                        </div>
                        <div class="geography-company-section__city">
                            <div class="geography-company-city geography-city-carousel fl fl-wr-w">
                                <?php
                                    $limit = Yii::app()->getModule('city')->itemsPerCity_1;
                                if ($category->id == 2) {
                                    $limit = Yii::app()->getModule('city')->itemsPerCity_2;
                                }
                                ?>
                                <?php foreach ($category->city(['condition' => 'city.name LIKE :search', 'params' => [':search' => '%'.$search.'%'], 'limit' => $limit]) as $key => $data) : ?>
                                    <?php Yii::app()->controller->renderPartial('//city/city/_item', ['data' => $data]) ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>