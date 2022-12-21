<?php

/**
 * PriceOverview
 */
class PriceOverview extends yupe\widgets\YWidget
{
    public $isButton = false;
    public $view = 'price-overview';
    public $order = null;
    public $system = null;

    public function run()
    {
        $cart = Yii::app()->cart;
        $positions = $cart->getPositions();
        $itemsCount = $cart->getItemsCount();

        if ($this->order) {
            $this->view = 'price-overview-last';
            $positions = $this->order->products;
            $itemsCount = $this->getItemsCount($positions);
        }

        $weight = 0;
        if ($positions) {
            foreach ($positions as $position) {
                $class = get_class($position);
                if ($class === 'OrderProduct') {
                    $weight += ($position->weight ?? 100) * $position->quantity;
                } else {
                    $weight += ($position->weight ?? 100) * $position->getQuantity();
                }
            }
        }
        if ($weight===0) {
            $weight = 1000;
        }

        $orderModule = Yii::app()->getModule('order');

        $coupons = [];
        $couponsSumm = 0;

        if (Yii::app()->hasModule('coupon')) {
            $couponCodes = Yii::app()->cart->couponManager->coupons;

            foreach ($couponCodes as $code) {
                $coupon = Coupon::model()->getCouponByCode($code);
                $coupons[] = $coupon;
                $couponsSumm += $coupon->value;
            }
        }

        $this->render($this->view, [
            'cart' => $cart,
            'positions' => $positions,
            'discountSumm' => $this->getDiscountSumm($positions),
            'orderModule' => $orderModule,
            'couponsSumm' => $couponsSumm,
            'isButton' => $this->isButton,
            'coupons' => $coupons,
            'itemsCount' => $itemsCount,
            'order' => $this->order,
            'system' => $this->system,
            'weight' => $weight,
        ]);
    }

    public function getDiscountSumm($positions)
    {
        $summ = 0;
        foreach ($positions as $position) {
        }

        return $summ;
    }

    public function getItemsCount($positions)
    {
        $count = 0;
        foreach ($positions as $position) {
            $count += $position->quantity;
        }

        return $count;
    }
}
