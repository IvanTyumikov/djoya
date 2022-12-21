<?php
/**
* Отображение для cdekBackend/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     https://yupe.ru
**/
$this->breadcrumbs = [
    Yii::t('CdekModule.cdek', 'cdek') => ['/cdek/cdekBackend/index'],
    Yii::t('CdekModule.cdek', 'Index'),
];

$this->pageTitle = Yii::t('CdekModule.cdek', 'cdek - index');

$this->menu = $this->getModule()->getNavigation();
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('CdekModule.cdek', 'cdek'); ?>
        <small><?php echo Yii::t('CdekModule.cdek', 'Index'); ?></small>
    </h1>
</div>