<nav class="header__nav-mobile">
    <div class="search__wrapper-mobile">
        <?php $this->widget('application.modules.store.widgets.SearchProductWidget', ['view' => 'search-product-header']); ?>
    </div>
    <?php $delay = 300; ?>
    <?php foreach ($this->params['items'] as $key => $item) : ?>
        <div class="listItem">
            <a class="listItemLink" href="<?= $item['url'] ?>" rel="<?= $item['linkOptions']['rel'] ?>"><span><?= $item['label'] ?></span></a>
        </div>
        <?php $delay = $delay + 50 ?>
    <?php endforeach; ?>
</nav>