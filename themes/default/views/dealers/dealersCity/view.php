<?php
/**
 * Отображение для ./themes/default/views/news/news/news.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this NewsController
 * @var $model News
 **/
?>

<?php
    $this->title = $model->meta_title ?: $model->name_short;
    $this->description = $model->meta_description;
    $this->keywords = $model->meta_keywords;
    Yii::app()->getClientScript()->registerScriptFile('//api-maps.yandex.ru/2.1/?lang=ru_RU', CClientScript::POS_END);
?>

<?php
$this->breadcrumbs = [
    // Yii::t('DealersModule.dealers', 'Дилерам') => ['/dealers/dealers/index'],
    $model->name
]; ?>

<div class="page-content dealersCity-content">
    <div class="container">
        
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>

        <h1><?= $model->title ? $model->title : CHtml::encode($model->name); ?></h1>

        <?= $model->description; ?>

        <div class="dealersCity-box">
            <div class="dealersCity-box__info">
                <?php if($model->listDealers()) : ?>
                    <div class="dealersCity-diler">
                        <?php $count = 1; ?>
                        <?php foreach ($model->listDealers(['order' => 'listDealers.position ASC']) as $key => $data) : ?>
                            <div class="dealersCity-diler__item">
                                <div class="dealersCity-diler__name">
                                    <a href="#map" class="goto" rel="<?= $count; ?>">
                                        <?= $data->name; ?>
                                    </a>
                                </div>
                                <div class="dealersCity-diler__loc">
                                    <?= $data->location; ?>
                                </div>
                                <div class="dealersCity-diler__mode">
                                    <?= $data->mode; ?>
                                </div>
                                <div class="dealersCity-diler__phone">
                                    <?= $data->phone; ?>
                                </div>
                            </div>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="dealersCity-box__map">
                <div id="myMap" style="height: 500px"></div>
            </div>
        </div>
    </div>
</div>

<?php Yii::app()->getClientScript()->registerScript("api-maps", "
    ymaps.ready(init);

    function init() {
        var myPoint = {$model->getCoordsMap()};
        // Создание экземпляра карты и его привязка к контейнеру с заданным id(myMap).
        var myMap = new ymaps.Map('myMap', {
            center: eval(myPoint[1][2]), 
            zoom: 16
        });

        var placemark = [];
        console.log(Object.keys(myPoint).length);
        // Метки
        for (var i = 1, n = Object.keys(myPoint).length; i <= n; ++i) { 

            placemark[i] = new ymaps.Placemark(eval(myPoint[i][2]), {
                hintLayout: myPoint[i][1],
            }, {

                iconLayout: 'default#image',
                // iconImageHref: '{$this->mainAssets}/images/icon/icon-map-marker.png',
                // iconImageSize: [35, 53],
                // iconImageOffset: [0, 0] 
            });
            myMap.geoObjects.add(placemark[i]);
            if(n > 1){
                myMap.setBounds(myMap.geoObjects.getBounds());
            }
        }

        // куда перейти
        function clickGoto() {
            var pos = this.getAttribute('rel');
            // переходим по координатам
            myMap.panTo(eval(myPoint[pos][2])).then(function () {
               myMap.setZoom(17);
               // placemark[pos].balloon.open();
            });
            // myMap.setCenter(eval(myPoint[pos][2]), 17, {duration: 300});
            // placemark[pos].balloon.open(myMap.getCenter());
            
            var top = $('#myMap').offset().top
            $('body,html').animate({
                scrollTop: top + 'px'
            }, 400);

            return false;
        }
        // навешиваем обработчики
        var col = document.getElementsByClassName('goto');
        for (var i = 0, n = col.length; i < n; ++i) {
            col[i].onclick = clickGoto;
        }
    }
"); ?>