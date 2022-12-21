<?php

/**
 * Class TextFilterWidget
 */
class TextFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'text-filter';

    /**
     * @var
     */
    public $attribute;
    /**
     * @throws Exception
     */
    public function init()
    {
        if (is_string($this->attribute)) {
            $this->attribute = AttributeStore::model()->findByAttributes(['name' => $this->attribute]);
        }

        if (!($this->attribute instanceof AttributeStore) || (int)$this->attribute->type !== AttributeStore::TYPE_SHORT_TEXT) {
            throw new Exception('Атрибут не найден или неправильного типа');
        }

        parent::init();
    }

    /**
     * @throws CException
     */
    public function run()
    {
        $this->render($this->view, ['attribute' => $this->attribute]);
    }
} 
