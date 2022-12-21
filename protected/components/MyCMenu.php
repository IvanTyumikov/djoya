<?php
Yii::import('zii.widgets.CMenu');
/**
 * FtListView
 */
class MyCMenu extends CMenu
{
    protected function renderMenu($items)
    {
        if(count($items))
        {
            echo CHtml::openTag('nav',$this->htmlOptions)."\n";
            $this->renderMenuRecursive($items);
            echo CHtml::closeTag('nav');
        }
    }

    protected function renderMenuItem($item)
    {
        if(isset($item['url']))
        {
            $label=$this->linkLabelWrapper===null ? $item['label'] : CHtml::tag($this->linkLabelWrapper, $this->linkLabelWrapperHtmlOptions, $item['label']);
            return CHtml::link($item['svg_icon'] . '<span>' . $label . '</span>',$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
        }
        else
            return CHtml::tag('span',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
    }
}
