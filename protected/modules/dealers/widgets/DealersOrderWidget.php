<?php
/**
 * DealersOrderWidget виджет формы "Дилерам"
 */
Yii::import('application.modules.dealers.models.*');

class DealersOrderWidget extends yupe\widgets\YWidget
{
    public $view = 'dealers-widget';

    public function run()
    {
        $model = new DealersOrder;
        
        if(isset($_POST['DealersOrder']['is_pl'])){
    		$model->scenario = str_replace('{template}', $_POST['DealersOrder']['is_pl'], DealersOrder::SCENARIO_TEMPLATE);
        }

        if (isset($_POST['DealersOrder'])) {
            $model->attributes = $_POST['DealersOrder'];
        	

            if($model->verify == ''){
                if ($model->save()) {
                    Yii::app()->user->setFlash('dealers-success', 'Ваша заявка успешно отправлена');
                    Yii::app()->controller->refresh();
                }
            }
        }      

        $this->render($this->view, [
            'model' => $model,
        ]);
    }
}
