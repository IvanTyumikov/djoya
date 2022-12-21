<?php
use yupe\widgets\YWidget;

/**
 * Class CheckboxOneFilterWidget
 */
class CheckboxOneFilterWidget extends YWidget
{
    /**
     * @var string
     */
    public $view = 'checkbox-one-filter';

    /**
     * @throws CException
     */
    public function run()
    {
        $this->render($this->view);
    }
}