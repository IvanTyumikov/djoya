<?php

Yii::import('application.modules.city.models.*');

/**
 * CityReplacement - замена городов в текстах по сайту
 */
class CityReplacementWidget extends \yupe\widgets\YWidget
{
    /**
     * @var component
     */
    protected $cityRepository;
    /**
     * @var array
     */
    public $_cities;
    /**
     * @var string
     */
    public $caseRus = 'именительный';  
    /**
     * @var string
     */
    public $pretext = 'в';
    /**
     * @var string
     */
    public $displayOnMain = 'true';
    /**
     * @var string
     */
    public $city;
    
    public function init(){
        $this->cityRepository = Yii::app()->getComponent('cityRepository');
        if (null === $this->_cities) {
            $this->_cities = $this->cityRepository->getListCities();
        }
        return parent::init();
    }

    public function run(){
        
        $city = null;
        
        if(null == $city){
            $cityUrl = $this->getCityFromUrl();
            if(null == $cityUrl && $this->displayOnMain == 'true'){
                $city->name = 'Оренбург';
            }else if(in_array($cityUrl, $this->_cities)){
                $city = $this->cityRepository->getCityBySlug($cityUrl);
            }
        }

        if ($this->city != '') {
            $city = $this->cityRepository->getCityBySlug($this->city);
        }

        if(!empty($this->caseRus)){
            $city->name = Yii::app()->inflection->wordInCase($city->name, $this->caseRus);
        }

        if($city->name == 'Череповеце'){
            $city->name = 'Череповце';
        }

        if($city->name != ''){
            echo html_entity_decode("&nbsp;".$this->pretext." ".$city->name);
        }
    }
    
    private function getCityFromUrl(){

        $request = Yii::app()->getRequest();
        $path = explode('/', $request->getPathInfo());
        if($path[0] != ''){
            $city = !empty($path[0]) ? $path[0] : null;
            if ($city === null) {
                $city = $request->getQuery($this->cityParam);
            }
            $city = in_array($city, $this->_cities, true) ? $city : null;
            return $city;
        }
    }
}
