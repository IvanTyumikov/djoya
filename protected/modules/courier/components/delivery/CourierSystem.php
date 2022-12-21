<?php

/**
 * Class CourierSystem
 */

Yii::import('application.modules.courier.CourierModule');
Yii::import('application.modules.courier.models.Courier');
Yii::import('application.modules.delivery.components.DeliverySystem');


/**
 * Class CourierSystem
 */
class CourierSystem extends DeliverySystem
{

    public $delivery;
    public $deliverySettings;
    public $order;

    public function renderCheckoutForm(Delivery $delivery, Order $order, $return = false)
    {

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap = [
                // В карте отключаем загрузку core-скриптов, УЖЕ подключенных до ajax загрузки
                'jquery.js' => false,
                'jquery.ui.js' => false,
                // На моей странице была ещё одна форма, поэтому jquery.yiiactiveform.js я исключил
                'jquery.yiiactiveform.js' => false,
            ];
        }

        $this->delivery = $delivery;
        $this->order = $order;
        $this->deliverySettings = $delivery->getDeliverySystemSettings();

        return Yii::app()->getController()->renderPartial(
            'application.modules.courier.views.form',
            [
                'order'    => $order,
                'delivery' => $delivery,
                'settings' => $delivery->getDeliverySystemSettings(),
            ],
            $return,
            true
        );
    }

    public function getMitCost(Delivery $delivery, Order $order)
    {
        $price = 0;
        $dadata = CJSON::decode($order->address_obj);

        // По городу
        /*
         *  ЖК "Дубки"
         *  микрорайон "Кушкуль"
         *  микрорайон "Ростоши"
         *  посёлок "Пригородный"
         *  микрорайон "имени Куйбышева"
         *  микрорайон "Солнечный"
         *  ЖК "Экодолье"
         *  посёлок "Весенний"
         *  ЖК "Перовский"
         *  село "Ивановка"
         *  микрорайон "Карачи"
         *  микрорайон "Южный"
         *  микрорайон "Бёрды"
        */
        // Пригород
        /*
         *  село "Нежинка"
         *  ЖК "Заречье" - поселок Ленина
         *  село "Южный Урал"
         *  хутор "Степановский"
         *  микрорайон "Авиагородок"
         * */
        if($dadata['region'] === 'Оренбургская'){
            if (
                $dadata['settlement'] == 'Нежинка' ||
                $dadata['settlement'] == 'Ленина' ||
                $dadata['settlement'] == 'Южный Урал' ||
                $dadata['settlement'] == 'Степановский' ||
                $dadata['city'] === 'Оренбург' && $dadata['street'] == 'Авиационная' ||
                $dadata['city'] === 'Оренбург' && $dadata['street'] == 'Летная'
            ) {
                $price = Yii::app()->cart->getCost() < 1000 ? 200 : 0;
            } else if (
                $dadata['city'] === 'Оренбург' ||
//                $dadata['city'] === 'Оренбург' && $dadata['street'] === 'Уральская' ||
                $dadata['settlement'] === 'Поселок Кушкуль' ||
                $dadata['settlement'] === 'Поселок Ростоши' ||
                $dadata['settlement'] === 'Пригородный' ||
//                $dadata['city'] === 'Оренбург' && $dadata['settlement'] === 'Поселок им Куйбышева' ||
//                $dadata['city'] === 'Оренбург' && $dadata['settlement'] === 'Солнечный' ||
                $dadata['settlement'] === 'Ивановка' ||
                $dadata['settlement'] === 'Весенний' ||
                $dadata['area'] === 'Оренбургский' && $dadata['settlement'] === 'Ивановка'
//                $dadata['city'] === 'Оренбург' && $dadata['settlement'] === 'Берды'
            ) {
                $price = Yii::app()->cart->getCost() < 500 ? 200 : 0;
            } else {
                $price = false;
            }
        } else {
            $price = false;
        }

        return $price;
    }

    /**
     * Получить стоимость доставки
     * @param $order Order
     * @param $delivery Delivery
     * @return float|int Стоимость доставки по выбранному тарифу
     */
    public function getCost($order, $delivery)
    {
        return (int) $this->getMitCost($delivery, $order);
    }
}
