<?php
Yii::import('application.modules.city.models.City');
/**
 * CityWidget
 */
class CityWidget extends \yupe\widgets\YWidget
{
    public $cityJson = '';

    public function run()
    {
        $model = City::model()->findAll();
        $cityList = CHtml::listData($model, 'id', 'name');

        $json = [];
        foreach ($model as $key => $city) {
            $phone = explode("<br>", $city->phone);
            $json[] = [
                // 'id' => $city->id,
                'name' => $city->name,
                'phone' => $phone[0],
                'email' => $city->email,
                'mode' => $city->mode,
                'location' => $city->address,
                'priceFile' => $city->getPathPriceFile(),
            ];
        }

        $this->cityJson = CJavaScript::encode($json);

        $this->_registerScript();

        $this->render('city-widget', [
            'model' => $model,
        ]);
    }

    protected function _registerScript()
    {
        Yii::app()->clientScript->registerScript(__FILE__, "
            
            var cityJson = {$this->cityJson};
            console.log(cityJson);
            
            if (getCookie('cityName') === undefined) {
                ymaps.ready(function(){
                    var geolocation = ymaps.geolocation;
                    
                    var c = cityJson.map(function(item, i) {
                        if(item.name == geolocation.city){
                            $('.js-city span').text(geolocation.city);

                            $('.js-filial-phone').html(item.phone);
                            $('.js-filial-email').html(item.email);
                            $('.js-filial-mode').html(item.mode);
                            $('.js-filial-location').html(item.location);

                        } 
                        // else{
                        //     $('.js-city span').text(cityJson[0].name);

                        //     $('.js-filial-phone').html(cityJson[0].phone);
                        //     $('.js-filial-email').html(cityJson[0].email);
                        //     $('.js-filial-mode').html(cityJson[0].mode);
                        //     $('.js-filial-location').html(cityJson[0].location);
                        // }
                        $('.js-poll').show();
                    });
                });
            } else {
                var cityId = getCookie('cityId');

                $('.js-city span').text(cityJson[cityId].name);
                $('.js-filial-phone').html(cityJson[cityId].phone);
                $('.js-filial-email').html(cityJson[cityId].email);
                $('.js-filial-mode').html(cityJson[cityId].mode);
                $('.js-filial-location').html(cityJson[cityId].location);
            }

            // При подтверждении что выбран мой город
            $('.js-poll-yes').on('click', function() {
                var cityName = $('.js-city span').text();

                cityJson.map(function(item, i) {
                    if (item.name == cityName.trim()) {
                        setCookie('cityName', cityName, {'path': '/'});
                        setCookie('cityId', i, {'path': '/'});
                        $('.js-poll').hide();
                    }
                });

                return false;
            });

            $('.js-poll-no').on('click', function() {
                var modal = $('.js-city').data('target');
                $(modal).modal('show');
                $('.js-poll').hide();
                return false;
            });
            
            $('.js-city-link').on('click', function() {
                var elem = $(this);
                var cityName = elem.text();
                var cityId = elem.data('id');
                setCookie('cityName', cityName, {'path': '/'});
                setCookie('cityId', cityId, {'path': '/'});
                window.location.reload();
                return false;
            });
        ");
    }
}
