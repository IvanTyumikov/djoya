<?php

/**
 * Class DeliveryManager
 */
class DeliveryManager extends CApplicationComponent
{
    /**
     * @var null
     */
    private $_deliverySystems = null;

    /**
     * @var null
     */
    private $_formattedList = null;

    /**
     * @var array
     */
    public $deliverySystems = [];

    /**
     * Возвращает список зарегистрированных способов доставки в формате array(id_delivery_system => delivery_system_object, ...)
     *
     * @return array
     * @throws CException
     */
    public function getDeliverySystems()
    {
        if ($this->_deliverySystems) {
            return $this->_deliverySystems;
        }

        $systems = [];
        foreach ($this->deliverySystems as $id => $params) {
            $system = Yii::createComponent($params);
            $systems[$id] = $system;
        }
        $this->_deliverySystems = $systems;

        return $this->_deliverySystems;
    }

    /**
     * Список способов доставки в виде array(id => 'Название', ...)
     * @return array
     */
    public function getSystemsFormattedList()
    {
        if ($this->_formattedList) {
            return $this->_formattedList;
        }
        $list = [];
        foreach ($this->getDeliverySystems() as $id => $system) {
            $params = $system->getParameters();
            $list[$id] = $params['name'];
        }
        $this->_formattedList = $list;

        return $this->_formattedList;
    }

    /**
     * @param $id
     * @return DeliverySystem|null
     * @throws CException
     */
    public function getDeliverySystemObject($id)
    {
        $systems = $this->getDeliverySystems();
        if (isset($systems[$id])) {
            return $systems[$id];
        }

        return null;
    }
}
