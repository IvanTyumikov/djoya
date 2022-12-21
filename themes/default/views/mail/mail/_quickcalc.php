<table style="width: 100%;">
	<tbody>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('name')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->name; ?></td>
		</tr>
		<tr>
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('phone')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->phone; ?></td>
		</tr>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('email')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->email; ?></td>
		</tr>
		<tr>
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('body')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->body; ?></td>
		</tr>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('method')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->getMethodName(); ?></td>
		</tr>
		<?php if($model->product) : ?>
			<tr>
				<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('product')?></strong></td>
				<td style="padding: 7px 10px;"><?= $model->product; ?></td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
