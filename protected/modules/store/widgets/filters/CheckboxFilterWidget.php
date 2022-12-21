<?php

/**
 * Class CheckboxFilterWidget
 */
class CheckboxFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'checkbox-filter';

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

        if (!($this->attribute instanceof AttributeStore) || $this->attribute->type != AttributeStore::TYPE_CHECKBOX) {
            throw new Exception(Yii::t('StoreModulle.store','Attribute error!'));
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
