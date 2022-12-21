<?php if($category): ?>
	<div class="category-filter__lists">
	    <?php foreach($category as $data):?>
	        <div class="category-filter__list">
	        	<a href="<?= $data->getCategoryUrl(); ?>" class="category-filter__link"><?= $data->name ?></a>
	        </div>
	    <?php endforeach;?>
	</div>
<?php endif; ?>
