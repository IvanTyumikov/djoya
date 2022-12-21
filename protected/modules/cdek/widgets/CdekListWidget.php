<?php

/**
 * CdekFormWidget
 */
class CdekListWidget extends CWidget
{
    public $system;

    public function run()
    {
        $this->render('cdek-list-widget', [
            'system' => $this->system,
        ]);
    }
}
