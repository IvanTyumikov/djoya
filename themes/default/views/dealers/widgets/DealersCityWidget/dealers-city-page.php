<?php if($dataProvider) : ?>
	<div class="dealers-page">
        <div class="content">
        	<div class="dealers-city-form">
        		<form id="dealers-city-form" action="">
        			<div class="dealers-form__input">
            			<div class="form-group">
							<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
								'name'=>'dealers-city-search',
								'source'=> $city,
								// additional javascript options for the autocomplete plugin
								'options'=>array(
									'minLength'=>'2',
								),
								'htmlOptions'=>array(
									'placeholder' => 'Найдите свой город'
									// 'style'=>'height:20px;',
								),
							)); ?>
            			</div>
        			</div>
        			<div class="dealers-form__button">
        				<button class="but but-burgundy" type="submit">Найти</button>
        			</div>
        		</form>
        	</div>
        	<?php $this->widget(
			    'bootstrap.widgets.TbListView',
			    [
			        'dataProvider'  => $dataProvider,
			        'id' => 'dealers-city-list',
			        'itemView'      => '_item',
			        'template'      => "{items}",
			        'itemsCssClass' => 'dealers-city-list',
			    ]
			); ?>
            <!-- <div class="dealers-city-list">
				<?php //foreach ($models as $key => $data) : ?>
					<div class="dealers-city-list__item">
						<a href="<?= Yii::app()->createUrl('/dealers/dealersCity/view', ['slug' => $data->slug]); ?>"><?= $data->name_short; ?></a>
					</div>
				<?php //endforeach; ?>
			</div> -->
        </div>
    </div>
<?php endif; ?>