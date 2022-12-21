<?php
/**
* Отображение для rupostBackend/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     https://yupe.ru
**/
$this->breadcrumbs = [
    Yii::t('RupostModule.rupost', 'rupost') => ['/rupost/rupostBackend/index'],
    Yii::t('RupostModule.rupost', 'Index'),
];

$this->pageTitle = Yii::t('RupostModule.rupost', 'rupost - index');

$this->menu = $this->getModule()->getNavigation();
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('RupostModule.rupost', 'rupost'); ?>
        <small><?php echo Yii::t('RupostModule.rupost', 'Index'); ?></small>
    </h1>
</div>