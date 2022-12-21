<?php
Yii::import('application.modules.city.models.*');
Yii::import('application.modules.page.models.*');
/**
 * CityVacanciesWidget - вывод вакансии по городам
 */
class CityVacanciesWidget extends \yupe\widgets\YWidget
{
   
    /**
     * @var component
     */
    protected $cityRepository;
    
    public function init(){
        $this->cityRepository = Yii::app()->getComponent('cityRepository');
        return parent::init();
    }

    public function run(){
        
        $cityId = $_COOKIE['cityId'];

        $city = !empty($cityId) ? $this->cityRepository->getById($cityId) : $this->cityRepository->getDefaultCity();
        
        $vacanciesCity = Page::model()->cityVacancies($city->id);
        
        $this->render('vacancies', [ 'vacanciesCity' => $vacanciesCity ]);
    }
}
