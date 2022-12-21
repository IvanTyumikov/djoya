<div class="product__items">
	<?php foreach ($product as $data) : ?>
		<?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
	<?php endforeach; ?>
</div>


