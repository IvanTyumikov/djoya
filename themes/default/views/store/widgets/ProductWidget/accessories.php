<div class="accessories">
	<?php foreach ($product as $data) : ?>
		<?php Yii::app()->controller->renderPartial('//store/product/_item-accessories', ['data' => $data]) ?>
	<?php endforeach; ?>
</div>


