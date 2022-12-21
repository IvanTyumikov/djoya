<?php
Yii::import('application.modules.city.models.City');
/**
 * CityGeoLocationWidget виджет определения города
 */
class CityGeoLocationWidget extends \yupe\widgets\YWidget
{
    public $cityJson = '';
    
    private $city_slug = 'city_slug';

    public function run()
    {
        $module = Yii::app()->getModule('city');

        if(empty(Yii::app()->request->cookies[$this->city_slug])){
            $this->setCity(Yii::app()->cityRepository->getDefaultCity());
        }
        elseif(!empty($_COOKIE['cityId'])){
            $this->setCity(Yii::app()->cityRepository->getSlugById($_COOKIE['cityId']));
        }
        
        $model = City::model()->findAll();
        $cityList = CHtml::listData($model, 'id', 'name');

        $json = [];
        foreach ($model as $key => $city) {

            $phone = explode("<br>", $city->phone);

            $json[] = [
                'id'        => $city->id,
                'name'      => $city->name,
                'phone'     => $phone[0],
                'email'     => $city->email,
                'mode'      => $city->mode,
                'location'  => $city->getAddress(),
                'code_map'  => $city->code_map,
                'vk'        => $city->vk,
                'instagram' => $city->instagram,
                'facebook'  => $city->facebook,
                'price' => [
                    'info' => ($city->price_file) ? $city->getPriceInfo() : '',
                    'link' => ($city->price_file) ? $city->getPathPriceFile() : '',
                ]
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

            if (getCookie('cityName') === undefined) {
                var url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip=';
                var token = '54d22130487049a58c7c55b74357116f7eb55b4b';
                var options = {
                    method: 'GET',
                    mode: 'cors',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Token ' + token
                    }
                }
                var data = function() {
                    return $.ajax(url, options);
                }

                data().then(function(response) {
                    var userAddress = response.location.data.city;
                    var i = -1;
                    cityJson.some(function(item) {
                        i++;
                        if(item.name == userAddress){
                            // $('.js-city span').text(userAddress);
                            setCookie('cityName', userAddress, {'path': '/'});
                            setCookie('cityKey', i, {'path': '/'});
                            setCookie('cityId', item.id, {'path': '/'});
                            // $('.js-city').fadeIn(300);
                            return item;
                        }    
                    }); 
                });             
                } else {
                    var cityKey = getCookie('cityKey');

                    // $('.js-city span').text(cityJson[cityKey].name);
                    // $('.js-city').fadeIn(300);
                }
        ");
}

protected function setCity($city){
    Yii::app()->getUser()->setState($this->city_slug, $city);
    Yii::app()->getRequest()->cookies[$this->city_slug] = new CHttpCookie($this->city_slug, $city);
}
}
