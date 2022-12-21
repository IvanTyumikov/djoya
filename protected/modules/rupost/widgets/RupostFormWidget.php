<?php

Yii::import('application.modules.rupost.forms.RupostForm');

/**
 * RupostFormWidget
 */
class RupostFormWidget extends CWidget
{
    /**
     * @var RupostSystem
     */
    public $system;

    public function run()
    {
        $model = new RupostForm;
        $model->setAttributes([
            'zipcode'   => $this->system->getPostPostalCode(),
            'region'    => $this->system->getPostRegion(),
            'city'      => $this->system->getPostCity() ?? $this->system->getPostSettlement(),
            'street'    => $this->system->getPostStreet(),
            'house'     => $this->system->getPostHouse(),
            'apartment' => $this->system->getPostFlat(),
        ]);

        if (isset($_POST['RupostForm'], $_POST['create'])) {
            $model->attributes = $_POST['RupostForm'];
            $model->validate();
        }

        $this->render('rupost-form-widget', [
            'model' => $model,
        ], false);
    }
}
