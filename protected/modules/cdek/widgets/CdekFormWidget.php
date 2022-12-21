<?php

/**
 * CdekFormWidget
 */
class CdekFormWidget extends CWidget
{
    /**
     * @var CdekSystem
     */
    public $system;

    public function run()
    {
        $model = new CdekForm;
        $model->setAttributes([
            'zipcode'    => $this->system->getPostPostalCode(),
            'region'    => $this->system->getPostRegion(),
            'city'    => $this->system->getPostCity() ?? $this->system->getPostSettlement(),
            'street'    => $this->system->getPostStreet(),
            'house'     => $this->system->getPostHouse(),
            'apartment' => $this->system->getPostFlat(),
        ]);

        if (isset($_POST['CdekForm'])) {
            $model->attributes = $_POST['CdekForm'];
            $model->validate();
        }

        $this->render('cdek-form-widget', [
            'model' => $model,
        ]);
    }
}
