<h1><?= $model->createOrder([]) ?></h1><br>
<a href="<?= Yii::app()->createUrl('/retailcrm/retailcrmBackend/index') ?>" class="btn btn-sm btn-primary">Обновить</a>
<a href="<?= Yii::app()->createUrl('/retailcrm/retailcrmBackend/remove') ?>" class="bulk-actions-btn btn btn-danger btn-sm">Очистить токены</a>