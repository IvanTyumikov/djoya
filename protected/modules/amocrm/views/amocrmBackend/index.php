<h1><?= $model->getApiClientStatus() ?></h1><br>
<a href="<?= Yii::app()->createUrl('/amocrm/amocrmBackend/index') ?>" class="btn btn-sm btn-primary">Обновить</a>
<a href="<?= Yii::app()->createUrl('/amocrm/amocrmBackend/remove') ?>" class="bulk-actions-btn btn btn-danger btn-sm">Очистить токены</a>