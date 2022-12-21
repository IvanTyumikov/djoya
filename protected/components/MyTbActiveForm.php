<?php

Yii::import('bootstrap.widgets.TbActiveForm');
/**
 * MyTbActiveForm
 */
class MyTbActiveForm extends TbActiveForm
{

    private $_summaryAttributes=array();

    public function run()
    {
        if(is_array($this->focus))
            $this->focus="#".CHtml::activeId($this->focus[0],$this->focus[1]);

        echo CHtml::endForm();
        $cs=Yii::app()->clientScript;
        if(!$this->enableAjaxValidation && !$this->enableClientValidation || empty($this->attributes))
        {
            if($this->focus!==null)
            {
                $cs->registerCoreScript('jquery');
                $cs->registerScript('CActiveForm#focus',"
                    if(!window.location.hash)
                        jQuery('".$this->focus."').focus();
                ");
            }
            return;
        }

        $options=$this->clientOptions;
        if(isset($this->clientOptions['validationUrl']) && is_array($this->clientOptions['validationUrl']))
            $options['validationUrl']=CHtml::normalizeUrl($this->clientOptions['validationUrl']);

        foreach($this->_summaryAttributes as $attribute)
            $this->attributes[$attribute]['summary']=true;
        $options['attributes']=array_values($this->attributes);

        if($this->summaryID!==null)
            $options['summaryID']=$this->summaryID;

        if($this->focus!==null)
            $options['focus']=$this->focus;

        if(!empty(CHtml::$errorCss))
            $options['errorCss']=CHtml::$errorCss;

        $options=CJavaScript::encode($options);
        $cs->registerCoreScript('yiiactiveform');
        $id=$this->id;
        $cs->registerScript(__CLASS__.'#'.$id,"jQuery('#$id').yiiactiveform($options);", CClientScript::POS_END, [
            'class' => 'js-deliviry-order-form'
        ]);
    }
}


