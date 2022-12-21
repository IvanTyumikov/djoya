<?php $slug = $_SERVER['REQUEST_URI']; ?>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="lk-content">
        <div class="container">
            <?php $this->widget('application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
            ]); ?>
            <h1><?= $this->title; ?></h1>
            <div class="lk-box">
                <div class="lk-box__menu">
                    <ul class="lk-menu">
                        <li class="<?= $slug == Yii::app()->createUrl('/user/profile/index') ? 'active' : ''; ?>">
                            <a href="<?= Yii::app()->createUrl('/user/profile/index'); ?>">Профиль</a>
                        </li>
                        <li class="<?= $slug == Yii::app()->createUrl('/order/user/index') ? 'active' : ''; ?>">
                            <a href="<?= Yii::app()->createUrl('/order/user/index'); ?>">История заказов</a>
                        </li>
                        <li class="<?= $slug == Yii::app()->createUrl('/user/profile/profile') ? 'active' : ''; ?>">
                            <a href="<?= Yii::app()->createUrl('/user/profile/profile'); ?>">Настройки</a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->createUrl('/user/account/logout'); ?>">Выйти</a>
                        </li>
                    </ul>
                </div>
                <div class="lk-box__content">
                    <?= $content; ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>
