<?php if($category) : ?>
	<?php foreach ($category as $key => $data) : ?>
		<li><a href="<?= $data->getCategoryUrl(); ?>"><?= $data->name; ?></a></li>
    <?php endforeach; ?>
<?php endif; ?>