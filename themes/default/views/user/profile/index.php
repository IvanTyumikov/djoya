<?php
$this->title = Yii::t('UserModule.user', 'Личный кабинет');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Личный кабинет')];
$this->layout = "//layouts/user";

?>

<div class="lk-user">
	<div class="lk-user__img">
		<?php if($user->avatar) : ?>
            <?= CHtml::image( '/uploads/' . $this->module->avatarsDir . '/' . $user->avatar, ''); ?>
        <?php else: ?>
            <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/user.png', '', ['class' => 'nophoto']); ?>
        <?php endif; ?>
	</div>
	<div class="lk-user__content">
		<div class="lk-user__info lk-user-info">
			<div class="lk-user__name lk-user-info__item">
				<div class="lk-user-info__heading">Ф.И.О.: </div>
				<div class="lk-user-info__body">
					<?php if($user->last_name || $user->first_name || $user->middle_name): ?>
						<?php if($user->last_name): ?>
							<?= $user->last_name; ?>
						<?php endif; ?>
						<?php if($user->first_name): ?>
							<?= $user->first_name; ?>
						<?php endif; ?>
						<?php if($user->middle_name): ?>
							<?= $user->middle_name; ?>
						<?php endif; ?>
					<?php else : ?>
						не указано
					<?php endif; ?>
				</div>
			</div>
			<div class="lk-user__gender lk-user__item lk-user-info__item">
				<div class="lk-user-info__heading">Пол: </div>
				<div class="lk-user-info__body">
					<?php if($user->gender): ?>
						<?= $user->getGender(); ?>
					<?php else: ?>
						не указан
					<?php endif; ?>
				</div>
			</div>
			<div class="lk-user__location lk-user__item lk-user-info__item">
				<div class="lk-user-info__heading">Адрес: </div>
				<div class="lk-user-info__body">
					<?php if($user->location): ?>
						<?= $user->location; ?>
					<?php else: ?>
						не указан
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="lk-user__contact lk-user-info">
			<h4>Контакты</h4>
			<div class="lk-user__phone lk-user__item lk-user-info__item">
				<div class="lk-user-info__heading">Телефон: </div>
				<div class="lk-user-info__body">
					<?php if($user->phone): ?>
						<?= $user->phone; ?>
					<?php else: ?>
						не указан
					<?php endif; ?>
				</div>
			</div>

			<?php if($user->email): ?>
				<div class="lk-user__email lk-user__item lk-user-info__item">
					<div class="lk-user-info__heading">E-mail: </div>
					<div class="lk-user-info__body">
						<?php if($user->email): ?>
							<?= $user->email; ?>
						<?php else: ?>
							не указан
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>