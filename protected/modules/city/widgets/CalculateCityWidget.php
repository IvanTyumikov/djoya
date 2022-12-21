<?php
Yii::import('application.modules.city.models.City');
/**
 * CalculateCityWidget
 */
class CalculateCityWidget extends \yupe\widgets\YWidget
{
    public $cityMyJson = '';
    public $cityJson = '';
    public $category_id = 1;

    public function run()
    {
    	if(isset($_COOKIE['cityId'])){
	    	$criteria = new CDbCriteria();
	    	// $criteria->compare('category_id', $this->category_id);

	        $model = City::model()->findAll($criteria);
	        
	        foreach ($model as $key => $city) {
	        	if($city->id == $_COOKIE['cityId']){
        			$cityMyJson[] = [
		                'id' => $city->id,
		                'name' => $city->name,
		                'location' => $city->address,
		                'coords' => "[{$city->coords}]",
		            ];
	        	} else if($city->category_id == $this->category_id) {
        			$cityJson[] = [
		                'id' => $city->id,
		                'name' => $city->name,
		                'location' => $city->address,
		                'coords' => "[{$city->coords}]",
		            ];
	        	}
 			}
    	}

	    // $info = file_get_contents('https://api.routing.yandex.net/v1.0.0/distancematrix');
	    // $info = json_decode($info, true);
	    echo '<pre>';
	    echo $_COOKIE['cityId'];
	    print_r($cityMyJson);
	    print_r($cityJson);
	    // Yii::app()->end();


        /*$json = [];
        foreach ($model as $key => $city) {
            $phone = explode("<br>", $city->phone);
            $json[] = [
                // 'id' => $city->id,
                'name' => $city->name,
                'phone' => $phone[0],
                'email' => $city->email,
                'mode' => $city->mode,
                'location' => $city->address,
                'coords' => $city->coords,
                'priceFile' => $city->getPathPriceFile(),
            ];
        }

        $this->cityJson = CJavaScript::encode($json);

        $this->_registerScript();

        $this->render('city-widget', [
            'model' => $model,
        ]);*/
    }

    protected function _registerScript()
    {
        Yii::app()->clientScript->registerScript(__FILE__, "
           
        ");
    }
}
