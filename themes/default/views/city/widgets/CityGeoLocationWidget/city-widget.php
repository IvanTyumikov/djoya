<div class="modal modal-my modal-my-xs fade" id="citymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header box-style">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                <div data-dismiss="modal" class="modal-close"><div></div></div>
                <div class="box-style__header">
                    <div class="box-style__heading">
                        Выберите ваш город
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <ul class="city-list">
                    <?php foreach ($model as $key => $item) : ?>
                        <li class="<?= (isset($_COOKIE['cityName']) and $_COOKIE['cityName'] == $item->name) ? 'active' : ''; ?>" >
                            <a class="js-city-link" href="#" data-city-slug="<?= $item->slug; ?>" data-id="<?= $item->id; ?>" data-key="<?= $key; ?>"><?= $item->name; ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
