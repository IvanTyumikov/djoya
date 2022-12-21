<?php
/**
* Отображение для courierBackend/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     https://yupe.ru
**/
$this->breadcrumbs = [
    Yii::t('CourierModule.courier', 'courier') => ['/courier/courierBackend/index'],
    Yii::t('CourierModule.courier', 'Index'),
];

$this->pageTitle = Yii::t('CourierModule.courier', 'courier - index');

$this->menu = $this->getModule()->getNavigation();
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('CourierModule.courier', 'courier'); ?>
        <small><?php echo Yii::t('CourierModule.courier', 'Index'); ?></small>
    </h1>
</div>