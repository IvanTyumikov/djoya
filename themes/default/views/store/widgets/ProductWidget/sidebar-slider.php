<?php if ($products) : ?>
    <div class="hits sidebar-hits">
        <div class="hits-title">
            <h2>
                <?= $this->title; ?>
            </h2>
        </div>
        <div class="hits-list js-hits-slider">
            <?php foreach ($products as $key => $data) : ?>
                <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data, 'isdelete' => false, 'isButton' => false]) ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>