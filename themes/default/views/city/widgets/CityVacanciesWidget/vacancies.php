<?php if(!empty($vacanciesCity)) : ?>
	<div class="vacancy-box">
		<?php foreach ($vacanciesCity as $vacancy): ?>
			<div class="vacancy-box__item">
				<div class="vacancy-box__header fl fl-wr-w fl-al-it-fl-s">
	                <div class="vacancy-box__name">
	                    <?= $vacancy->title_short; ?>
	                </div>
	                <div class="vacancy-box__but"><div></div></div>
	            </div>
	            <div class="vacancy-box__body">
	                <div class="vacancy-box__content">
	                    <?= $vacancy->body; ?>
		    			<?php //= Chtml::link('Подробнее', Yii::app()->createUrl('/page/page/view/', [ 'slug' => $vacancy->slug ])); ?>
	                </div>
	            </div>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<div class="txt-style">
		На данный момент нет свободных вакансий!
	</div>
<?php endif; ?>
 