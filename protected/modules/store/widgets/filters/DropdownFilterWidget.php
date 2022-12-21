<?php

/**
 * Class DropdownFilterWidget
 */
class DropdownFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'dropdown-filter';

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

        if (!($this->attribute instanceof AttributeStore) || !$this->attribute->isMultipleValues()) {
            throw new Exception(Yii::t('StoreModulle.store','AttributeStore error!'));
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
