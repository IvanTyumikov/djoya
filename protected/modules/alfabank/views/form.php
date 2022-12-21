<?php
/**
 * @var string $action Form action url
 * @var string $sessionId
 */

?>
<?= CHtml::beginForm($action, 'GET') ?>
<?= CHtml::submitButton(Yii::t('AlfabankModule.alfabank','Pay')) ?>
<?= CHtml::endForm() ?>