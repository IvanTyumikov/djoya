<?php
Yii::import('application.modules.delivery.components.DeliverySystem');
/**
 * Class ManualDeliverySystem
 */
class ManualDeliverySystem extends DeliverySystem
{
    /**
     * @var null
     */
    public $parametersFile = null;

    /**
     * @param array $deliverySettings
     * @param bool $return
     * @return null
     */
    public function renderSettings($deliverySettings = [], $return = false)
    {
        return null;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return ['name' => 'Без модуля'];
    }
}
