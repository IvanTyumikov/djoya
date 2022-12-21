<?php if ($products) : ?>
    <div class="hits">
        <div class="hits-title">
            <h2>
                <?= $this->title; ?>
            </h2>
            <!-- <a href="/hits">
                Все <?= mb_strtolower($this->title); ?>
            </a> -->
        </div>
        <div class="hits-list">
            <?php foreach ($products as $key => $data) : ?>
                <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data, 'isdelete' => false, 'isButton' => false]) ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>