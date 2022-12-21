<div class="footer-menu">
    <div class="footer-menu__title">
        Покупателям
    </div>
    <div class="footer-menu__list">
        <?php foreach ($this->params['items'] as $key => $item) : ?>
            <a href="<?= $item['url'] ?>" rel="<?= $item['linkOptions']['rel'] ?>" class="footer-menu__item">
                <?= $item['label'] ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>