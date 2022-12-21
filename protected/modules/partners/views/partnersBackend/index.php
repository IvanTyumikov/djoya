<?php
/**
* Отображение для partnersBackend/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     https://yupe.ru
**/
$this->breadcrumbs = [
    Yii::t('PartnersModule.partners', 'Партнеры') => ['/partners/partnersBackend/index'],
    Yii::t('PartnersModule.partners', 'Управление'),
];

$this->pageTitle = Yii::t('PartnersModule.partners', 'Партнеры - управление');

$this->menu = $this->getModule()->getNavigation();
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('PartnersModule.partners', 'Партнеры'); ?>
        <small><?php echo Yii::t('PartnersModule.partners', 'управление'); ?></small>
    </h1>
</div>