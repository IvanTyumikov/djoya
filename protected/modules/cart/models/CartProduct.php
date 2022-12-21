<?php

/**
 * Class CartProduct
 */
class CartProduct extends Product implements IECartPosition
{
    /**
     * @param null|string $className
     * @return Product
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return mixed
     */
    public function getProductModel()
    {
        return Product::model()->findByPk($this->id);
    }

    /**
     * Выбирает слово с правильными окончанием после числительного.
     *
     * @param int $number число
     * @param array $words варианты склонений ['яблоко', 'яблока', 'яблок']
     * @return string
     *
     */
    public function getPlural(int $number, array $words): string
    {
        return $words[($number % 100 > 4 && $number % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][min($number % 10, 5)]];
    }
}
