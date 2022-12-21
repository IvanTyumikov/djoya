<?php
/**
* @category YupeView
* @package  YupeCMS
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     http://yupe.ru
*
* @var $this StocksController
* @var $model Stocks
**/
?>
<?php

$this->title = $model->title ? $model->title : $model->title;
$this->description = $model->description;

?>

<?php
$this->breadcrumbs = [
	$model->title,
];
?>

<div class="container">
	<div class="page-title">
		<h1><?= $model->title; ?></h1>
	</div>
	<!-- <img src="<?php /*$model->getImageUrl(316, 269, true);*/ ?>" alt=""> -->
	<div><?= $model->full_text; ?></div><br>
</div>