<?php if($models) : ?>
	<div class="geography-page-company">
		<div class="geography-tabs-nav fl fl-wr-w fl-al-it-c">
			<?php foreach ($models as $key => $category) : ?>
				<div class="geography-tabs-nav__item fl fl-al-it-c">
					<a data-toggle="tab" href="#geography-pane-<?= $category->id; ?>">
						<?= $category->name_short; ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="geography-tabs-content">
			<?php foreach ($models as $key => $category) : ?>
				<div class="geography-tabs-content__item geography-pane tab-pane fade" id="geography-pane-<?= $category->id; ?>">
					<div class="geography-company-city fl fl-wr-w">
						<?php foreach ($category->city() as $key => $data) : ?>
							<?php Yii::app()->controller->renderPartial('//city/city/_item', ['data' => $data]) ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php Yii::app()->getClientScript()->registerScript("geography-tabs-nav", "
		$('.geography-tabs-nav .geography-tabs-nav__item:eq(0)').addClass('active');
	    $('.geography-tabs-nav .geography-tabs-nav__item:eq(0) a').tab('show');

	    $(document).delegate('.geography-tabs-nav a', 'click', function(e){
	        $('.geography-tabs-nav .geography-tabs-nav__item').removeClass('active');
	        $(this).parent().addClass('active');
	        var id = $(this).attr('href');
	        $('.geography-page-pane').removeClass('active');
	        $(id).addClass('geography-tabs-loading');
	        setTimeout(function(){
	            $(id).removeClass('geography-tabs-loading').addClass('active');
	        }, 500);

	        return false;
	    });
    "); ?>
<?php endif; ?>