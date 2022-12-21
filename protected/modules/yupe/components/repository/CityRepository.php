<?php

/**
 * Class CityRepository
 */
class CityRepository extends CApplicationComponent{
    
    public function getListCities(){
        $cities = City::model()->getAvailableCities();
        return $cities;
    }
    
    public function getDefaultCity(){
        $city = City::model()->getDefaultCity();
        return $city;
    }
    
    public function getMainDefaultCity(){
        $city = City::model()->getMainDefaultCity();
        return $city;
    }
    
    public function getSlugById($id){
        $city = City::model()->findByPk($id);
        return $city->slug;
    }
    
    public function getCityBySlug($slug){
        $city = City::model()->findByAttributes(['slug' => $slug]);
        return $city;
    }
    
    public function getById($id){
        $city = City::model()->findByPk($id);
        return $city;
    }
    
    public function getCityFromUrl($url){
        $cities_slug = City::model()->getAvailableCities();
        $city = null;
        foreach ($cities_slug as $city_slug) {
            if(stristr($url, $city_slug)){
                $city = City::model()->findByAttributes(['slug' => $city_slug]);
            }
        }

        return $city;
    }
 
}