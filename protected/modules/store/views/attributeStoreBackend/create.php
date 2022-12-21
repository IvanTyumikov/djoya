<?php
$this->breadcrumbs = [
    Yii::t('StoreModule.store', 'Attributes') => ['/store/attributeStoreBackend/index'],
    Yii::t('StoreModule.store', 'Creating'),
];

$this->pageTitle = Yii::t('StoreModule.store', 'Attributes - creating');

$this->menu = [
    [
        'icon' => 'fa fa-fw fa-list-alt',
        'label' => Yii::t('StoreModule.store', 'Manage attributes'),
        'url' => ['/store/attributeStoreBackend/index'],
    ],
    [
        'icon' => 'fa fa-fw fa-plus-square',
        'label' => Yii::t('StoreModule.store', 'Create attribute'),
        'url' => ['/store/attributeStoreBackend/create'],
    ],
];
?>
<div class="page-header">
    <h1>
        <?= Yii::t('StoreModule.store', 'Attribute'); ?>
        <small><?= Yii::t('StoreModule.store', 'creating'); ?></small>
    </h1>
</div>

<?= $this->renderPartial('_form', [
    'model' => $model,
    'types' => $types,
]); ?>