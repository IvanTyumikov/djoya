<?php

/**
 * CourierForm
 */
class CourierForm extends CFormModel
{
    public $street;
    public $house;
    public $apartment;

    public function rules()
    {
        return [
            ['street, house', 'required'],
            ['street, house, apartment', 'length', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'street' => 'Улица',
            'house' => 'Дом',
            'apartment' => 'Квартира',
        ];
    }
}
