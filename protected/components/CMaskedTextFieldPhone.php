<?php

/**
 * d
 */
class CMaskedTextFieldPhone extends CMaskedTextField
{
    public function run()
    {
        if ($this->mask=='') {
            throw new CException(Yii::t('yii', 'Property CMaskedTextField.mask cannot be empty.'));
        }

        list($name,$id)=$this->resolveNameID();
        if (isset($this->htmlOptions['id'])) {
            $id=$this->htmlOptions['id'];
        } else {
            $this->htmlOptions['id']=$id;
        }
        if (isset($this->htmlOptions['name'])) {
            $name=$this->htmlOptions['name'];
        }

        $this->registerClientScript();

        if ($this->hasModel()) {
            echo CHtml::activeTelField($this->model, $this->attribute, $this->htmlOptions);
        } else {
            echo CHtml::telField($name, $this->value, $this->htmlOptions);
        }
    }
}
