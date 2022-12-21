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
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('body')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->body; ?></td>
		</tr>
		<tr>
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('summ')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->summ; ?></td>
		</tr>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('material')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->getMaterial()[$model->material]; ?></td>
		</tr>
		<tr>
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('length')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->length; ?></td>
		</tr>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('width')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->width; ?></td>
		</tr>
		<tr>
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('area')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->area; ?></td>
		</tr>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('angle')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->angle; ?></td>
		</tr>
		<tr>
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('pipes')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->pipes; ?></td>
		</tr>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('cornice')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->cornice; ?></td>
		</tr>
		<tr>
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('luster')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->luster; ?></td>
		</tr>
		<tr style="background: #ececec;">
			<td style="padding: 7px 10px;"><strong><?= $model->getAttributeLabel('lamp')?></strong></td>
			<td style="padding: 7px 10px;"><?= $model->lamp; ?></td>
		</tr>
	</tbody>
</table>
