<div class="mobile">
    <div class="container">
        <div class="mobile__close">
            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/app.svg'); ?>
        </div>
    	<div class="mobile__main">
            <nav class="mobile__nav">
                <li>
                    <a href="<?= Yii::app()->createUrl('store/product/index') ?>">Каталог</a>
                </li>
            </nav>
    	    <?php if (Yii::app()->hasModule('menu')): ?>
    	        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'mobile-menu', 'name' => 'top-menu']); ?>
    	    <?php endif; ?>
            <div class="footer-contacts">
                <a href="mailto:<?= Yii::app()->getModule('yupe')->email ?>" class="footer-contacts__mail"><?= Yii::app()->getModule('yupe')->email ?></a>
                <div class="footer-contacts__time">Пн-Вс <?= Yii::app()->getModule('yupe')->time ?></div>
                    <a href="tel:<?= Yii::app()->getModule('yupe')->phone1 ?>"
                       class="footer-contacts__phone"
                       onclick="yaCounter<?= Yii::app()->params['metrika'] ?>.reachGoal('click');">
                        <?= Yii::app()->getModule('yupe')->phone1 ?>
                    </a><br>
                    <a href="#" class="footer-contacts__link-modal button_red" data-toggle="modal" data-target="#callbackModal">Заказать звонок</a>
                </div>
            <div class="footer-contacts">
                <?php $this->widget('application.modules.city.widgets.CityReplacementWidget', ['displayOnMain' => false, 'pretext' => 'г.']); ?>
            </div>
    	</div>
    </div>
</div>