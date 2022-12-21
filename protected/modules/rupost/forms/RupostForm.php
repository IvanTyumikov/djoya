<?php

/**
 * RupostForm
 */
class RupostForm extends CFormModel
{
    public $zipcode;
    public $region;
    public $city;
    public $street;
    public $house;
    public $apartment;

    public function rules()
    {
        return [
            ['street, house, zipcode, region, city', 'required'],
            ['street, house, zipcode, region, city', 'length', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'zipcode'   => 'Индекс',
            'region'    => 'Регион',
            'city'      => 'Населенный пункт',
            'street'    => 'Улица',
            'house'     => 'Дом',
            'apartment' => 'Квартира',
        ];
    }
}
