<?php
namespace yupe\widgets\editors;

use Yii;
use CInputWidget;
use CHtml;

/**
 * Class Textarea
 * @package yupe\widgets\editors
 */
class Textarea extends \CInputWidget
{

    /**
     * @var array
     */
    public $options = [];
    public $height = 500;

    /**
     *
     */
    public function init(){
        $assets = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('vendor').'/codemirror/codemirror/'
        );

        Yii::app()->getClientScript()->registerCssFile($assets . '/lib/codemirror.css');
        Yii::app()->getClientScript()->registerCssFile($assets . '/theme/monokai.css');

        Yii::app()->getClientScript()->registerScriptFile($assets . '/lib/codemirror.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/xml/xml.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/php/php.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/javascript/javascript.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/css/css.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/mode/htmlmixed/htmlmixed.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/addon/edit/matchbrackets.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/addon/search/search.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/addon/search/searchcursor.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/emmet/emmet.js');
        Yii::app()->getClientScript()->registerScriptFile($assets . '/keymap/sublime.js');
    }

    public function run()
    {
        if ($this->model) {
            echo CHtml::activeTextArea(
                $this->model,
                $this->attribute,
                \CMap::mergeArray($this->getOptions(), $this->options)
            );
        } else {
            echo CHtml::textArea($this->name, $this->value, \CMap::mergeArray($this->getOptions(), $this->options));
        }

        Yii::app()->getClientScript()->registerScript(
            '#mytextarea',
            "$('.mytextarea').each(function(){
                var editor = CodeMirror.fromTextArea(this, {
                    lineNumbers: true,
                    lineWrapping: true,
                    mode: 'text/html',
                    keyMap: 'sublime',
                    theme: 'monokai',
                    matchBrackets: true
                });
                editor.setSize(null, {$this->height});
                emmetCodeMirror(editor);
            });"
        );
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            'class' => 'form-control mytextarea',
            'rows' => '10',
            'style' => 'resize: vertical;',
        ];
    }
}
