<?php Yii::app()->getModule('store'); ?>
<div class="header <?= $this->isHome ? 'header_home' : '' ?>">
    <div class="container">
        <div class="header__main">
            <a href="/" class="header-logo">
                <img src="<?= $this->mainAssets . '/images/logo.png' ?>" alt="logo">
            </a>

            <?php if (Yii::app()->hasModule('menu')) : ?>
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'top-menu', 'name' => 'top-menu']); ?>
            <?php endif; ?>

            <div class="header-inter">
                <div class="search">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/search.svg'); ?>
                </div>
                <?php if (Yii::app()->hasModule('favorite')) : ?>
                    <a href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>" class="header-favorite">
                        <span class="header-favorite__icon">
                            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/favorite.svg'); ?>
                            <span class="header-favorite__count js-favorite-total <?= (Yii::app()->favorite->count() != null) ? 'active' : 'hidden'; ?>" id="yupe-store-favorite-total">
                                <?= Yii::app()->favorite->count(); ?>
                            </span>
                        </span>
                    </a>
                <?php endif; ?>
                <?php if (Yii::app()->hasModule('cart')) : ?>
                    <div class="header-cart shopping-cart-widget" id="shopping-cart-widget">
                        <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
                    </div>
                <?php endif; ?>
                <div class="app">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/app.svg'); ?>
                </div>
            </div>

            <div class="header-line">
                <img src="<?= $this->mainAssets . '/images/header/header-line.svg' ?>" alt="">
            </div>

            <!-- <div class="top-catalog">
                <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
                    'view' => 'category-top',
                ]); ?>
            </div> -->
        </div>
        <div class="header__main header-mobile">
            <div class="header-inter">
                <div class="search">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/search.svg'); ?>
                </div>
                <?php if (Yii::app()->hasModule('favorite')) : ?>
                    <a href="<?= Yii::app()->createUrl('/favorite/default/index'); ?>" class="header-favorite">
                        <span class="header-favorite__icon">
                            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/favorite.svg'); ?>
                            <span class="header-favorite__count js-favorite-total <?= (Yii::app()->favorite->count() != null) ? 'active' : 'hidden'; ?>" id="yupe-store-favorite-total">
                                <?= Yii::app()->favorite->count(); ?>
                            </span>
                        </span>
                    </a>
                <?php endif; ?>
                <?php if (Yii::app()->hasModule('cart')) : ?>
                    <div class="header-cart shopping-cart-widget" id="shopping-cart-widget">
                        <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
                    </div>
                <?php endif; ?>
                <div class="app">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/app.svg'); ?>
                </div>
            </div>

            <a href="/" class="header-logo">
                <img src="<?= $this->mainAssets . '/images/logo.svg' ?>" alt="logo">
            </a>

            <div id="nav-icon3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="header-line">
                <img src="<?= $this->mainAssets . '/images/header/header-line.svg' ?>" alt="">
            </div>

            <?php if (Yii::app()->hasModule('menu')) : ?>
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'mobile-menu', 'name' => 'top-menu', 'assets' => $this->mainAssets]); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="search__wrapper">
    <?php $this->widget('application.modules.store.widgets.SearchProductWidget', ['view' => 'search-product-header']); ?>
</div>

<!-- <div class="menu">
    <div class="container">
        <?php if (Yii::app()->hasModule('menu')) : ?>
            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'top-menu', 'name' => 'top-menu']); ?>
        <?php endif; ?>
    </div>
</div> -->