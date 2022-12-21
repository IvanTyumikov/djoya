<?php if($dataProvider) : ?>
	<div class="dealers-home">
        <div class="container">
            <div class="dealers-tabs">
                <div class="dealers-tabs__nav">
                    <div class="dealers__title">Партнеры Kovtyrin</div>
                    <ul class="dealers-tabs__nav-item nav nav-tabs" id="myTab">
                        <?php foreach($dataProvider->getData() as $key => $data): ?>
                            <li class="<?= $key == 0 ? 'active' : ''?> my-tab_<?= $data->id; ?>">
                                <a data-id="<?= $data->id; ?>" href="#<?= $data->slug; ?>" data-toggle="tab"><?= $data->name_short; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#" class="dealers__buy-link button-red">
                        <span>Где купить</span>
                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/plus.svg'); ?>
                    </a>
                </div>
                <div class="dealers-tabs__content tab-content">
                    <?php foreach($dataProvider->getData() as $key => $data): ?>
                        <div class="tab-pane <?= $key == 0 ? 'active' : ''?>" id="<?= $data->slug; ?>">
                            <div class="dealersCity-box">
                                <div class="dealersCity-box__info">
                                    <?php if($data->listDealers()) : ?>
                                        <div class="dealersCity-diler">
                                            <?php $count = 1; ?>
                                            <?php foreach ($data->listDealers(['order' => 'listDealers.position ASC']) as $key => $item) : ?>
                                                <div class="dealersCity-diler__item">
                                                    <div class="dealersCity-diler__name">
                                                        <a href="#map" class="goto<?= $data->id ?>" rel<?= $data->id ?>="<?= $count; ?>">
                                                            <?= $item->name; ?>
                                                        </a>
                                                    </div>
                                                    <div class="dealersCity-diler__loc">
                                                        <?= $item->location; ?>
                                                    </div>
                                                    <div class="dealersCity-diler__mode">
                                                        <?= $item->mode; ?>
                                                    </div>
                                                    <!-- <div class="dealersCity-diler__phone">
                                                        <?= $item->phone; ?>
                                                    </div> -->
                                                </div>
                                                <?php $count++; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="dealersCity-box__map">
                                    <div id="myMap<?= $data->id ?>" style="height: 364px"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <?php //Не обращаем внимание, все путем, нормальный код :D ?>
    <?php foreach($dataProvider->getData() as $key => $data): ?>
        <?php Yii::app()->getClientScript()->registerScript("api-maps_{$data->slug}", "
            ymaps.ready(init{$data->id});

            function init{$data->id}() {
                var myPoint{$data->id} = {$data->getCoordsMap()};
                // Создание экземпляра карты и его привязка к контейнеру с заданным id(myMap).
                var myMap{$data->id} = new ymaps.Map('myMap{$data->id}', {
                    center: eval(myPoint{$data->id}[1][2]), 
                    zoom: 16
                });

                var placemark{$data->id} = [];
                console.log(Object.keys(myPoint{$data->id}).length);
                // Метки
                for (var i = 1, n = Object.keys(myPoint{$data->id}).length; i <= n; ++i) { 

                    placemark{$data->id}[i] = new ymaps.Placemark(eval(myPoint{$data->id}[i][2]), {
                        hintLayout: myPoint{$data->id}[i][1],
                    }, {

                        iconLayout: 'default#image',
                        // iconImageHref: '/images/icon/icon-map-marker.png',
                        // iconImageSize: [35, 53],
                        // iconImageOffset: [0, 0] 
                    });
                    myMap{$data->id}.geoObjects.add(placemark{$data->id}[i]);
                    if(n > 1){
                        myMap{$data->id}.setBounds(myMap{$data->id}.geoObjects.getBounds());
                    }

                    if({$data->id} > 1){
                        setTimeout(function () {
                            
                        }, 400);
                    }
                }

                $('.my-tab_{$data->id} a[data-toggle=\"tab\"]').on('shown.bs.tab', function (e) {
                    var id = $(this).data('id');
                    myMap{$data->id}.setZoom(12);
                });

                // куда перейти
                function clickGoto{$data->id}() {
                    var pos{$data->id} = this.getAttribute('rel{$data->id}');
                    // переходим по координатам
                    myMap{$data->id}.panTo(eval(myPoint{$data->id}[pos{$data->id}][2])).then(function () {
                       myMap{$data->id}.setZoom(17);
                       // placemark{$data->id}[pos{$data->id}].balloon.open();
                    });
                    // myMap{$data->id}.setCenter(eval(myPoint{$data->id}[pos{$data->id}][2]), 17, {duration: 300});
                    // placemark{$data->id}[pos{$data->id}].balloon.open(myMap{$data->id}.getCenter());
                    
                    var top = $('#myMap{$data->id}').offset().top
                    // $('body,html').animate({
                    //     scrollTop: top + 'px'
                    // }, 400);

                    return false;
                }
                // навешиваем обработчики
                var col{$data->id} = document.getElementsByClassName('goto{$data->id}');
                for (var i = 0, n = col{$data->id}.length; i < n; ++i) {
                    col{$data->id}[i].onclick = clickGoto{$data->id};
                }
            }
        "); ?>
    <?php endforeach; ?>
<?php endif; ?>