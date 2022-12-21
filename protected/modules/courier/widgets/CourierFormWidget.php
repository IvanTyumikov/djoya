<?php

Yii::import('application.modules.courier.forms.CourierForm');

/**
 * CourierFormWidget
 */
class CourierFormWidget extends CWidget
{
    /**
     * @var CourierSystem
     */
    public $system;

    public function run()
    {
        $model = new CourierForm;
        
        $module = Yii::app()->deliveryManager->getDeliverySystemObject('courier');

        $model->setAttributes([
            'street'    => $module->getPostStreet(),
            'house'     => $module->getPostHouse(),
            'apartment' => $module->getPostFlat(),
        ]);

        if (isset($_POST['CourierForm'], $_POST['create'])) {
            $model->attributes = $_POST['CourierForm'];
            $model->validate();
        }

        $this->render('courier-form-widget', [
            'model' => $model,
        ], false);
    }
}
