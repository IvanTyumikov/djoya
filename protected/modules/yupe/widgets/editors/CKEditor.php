<?php
namespace yupe\widgets\editors;

use Yii;
use CInputWidget;

/**
 * Class CKEditor
 * @package yupe\widgets\editors
 */
class CKEditor extends \CInputWidget
{
    /**
     * @var array
     */
    public $editorOptions = [];

    /**
     * @throws \Exception
     */
    public function run()
    {
        list($name, $id) = $this->resolveNameID();

        $this->htmlOptions['id'] = $id;

        if ($this->hasModel()) {
            echo \CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
        } else {
            echo \CHtml::textArea($name, $this->value, $this->htmlOptions);
        }

        $this->registerClientScript($id);
    }

    /**
     * @param $id
     */
    public function registerClientScript($id)
    {
        $elFinderConnect = Yii::app()->createUrl('/yupe/backend/ElFinderConnection');

        $options = [
            'language' => Yii::app()->getLanguage(),
            'filebrowserBrowseUrl' => '#',
            'filebrowserUploadUrl' => Yii::app()->createUrl('/yupe/backend/ElFinderConnection'),
            'imageUploadUrl' => Yii::app()->createUrl('/yupe/backend/ElFinderConnection'),
            'extraPlugins' => 'autolink,codesnippet,div,font,bidi,justify,table,tableresize,tabletools,colorbutton,colordialog,stylesheetparser,docprops,lineutils,liststyle,find,uploadimage,image2',
            'toolbar' => [
              [ 'name' => 'document', 'groups' => [ 'mode', 'document', 'doctools' ], 'items' => [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] ],
              [ 'name' => 'clipboard', 'groups' => [ 'clipboard', 'undo' ], 'items' => [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] ],
              [ 'name' => 'editing', 'groups' => [ 'find', 'selection', 'spellchecker' ], 'items' => [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] ],
              [ 'name' => 'forms', 'items' => [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] ],
              '/',
              [ 'name' => 'basicstyles', 'groups' => [ 'basicstyles', 'cleanup' ], 'items' => [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] ],
              [ 'name' => 'paragraph', 'groups' => [ 'list', 'indent', 'blocks', 'align', 'bidi' ], 'items' => [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] ],
              [ 'name' => 'links', 'items' => [ 'Link', 'Unlink', 'Anchor' ] ],
              [ 'name' => 'insert', 'items' => [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] ],
              '/',
              [ 'name' => 'styles', 'items' => [ 'Styles', 'Format', 'Font', 'FontSize' ] ],
              [ 'name' => 'colors', 'items' => [ 'TextColor', 'BGColor' ] ],
              [ 'name' => 'tools', 'items' => [ 'Maximize', 'ShowBlocks' ] ],
              [ 'name' => 'others', 'items' => [ '-' ] ],
              [ 'name' => 'about', 'items' => [ 'About' ] ]
            ],
            'toolbarGroups' => [
              [ 'name' => 'document', 'groups' => [ 'mode', 'document', 'doctools' ] ],
              [ 'name' => 'clipboard', 'groups' => [ 'clipboard', 'undo' ] ],
              [ 'name' => 'editing', 'groups' => [ 'find', 'selection', 'spellchecker' ] ],
              [ 'name' => 'forms' ],
              '/',
              [ 'name' => 'basicstyles', 'groups' => [ 'basicstyles', 'cleanup' ] ],
              [ 'name' => 'paragraph', 'groups' => [ 'list', 'indent', 'blocks', 'align', 'bidi' ] ],
              [ 'name' => 'links' ],
              [ 'name' => 'insert' ],
              '/',
              [ 'name' => 'styles' ],
              [ 'name' => 'colors' ],
              [ 'name' => 'tools' ],
              [ 'name' => 'others' ],
              [ 'name' => 'about' ]
            ],
            'removeButtons' => '',
            // 'extraPlugins' => 'table,tableresize,tabletools,colorbutton,colordialog,uploadimage,image2',
            // 'filebrowserUploadUrl' => Yii::app()->createUrl('/yupe/backend/AjaxImageUploadCKE'),
            // 'extraPlugins' => 'table,tableresize,tabletools,stylesheetparser,embed,image,filetools,docprops,lineutils,liststyle,find,uploadwidget',',
            'autoParagraph' => false,
            'removeDialogTabs' => '',
            'format_tags' => 'p;h1;h2;h3;h4;h5;h6;pre',
        ];

        $assets = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('vendor').'/ckeditor/ckeditor/'
        );

        Yii::app()->getClientScript()->registerScriptFile($assets.'/ckeditor.js', \CClientScript::POS_HEAD);
        Yii::app()->getClientScript()->registerScriptFile(
            $assets.'/lang/'.Yii::app()->getLanguage().'.js',
            \CClientScript::POS_HEAD
        );

        $options = \CJavaScript::encode(\CMap::mergeArray($options, $this->editorOptions));


        $assetsfm = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('application.modules.yupe.views.assets.js')
        );

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerCssFile($cs->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');


        $cs->scriptMap = [
            // 'jquery.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            // 'jquery.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            'jquery-ui.js' => "{$assetsfm}/jquery-ui-1.12.min.js",
            'jquery-ui.min.js' => "{$assetsfm}/jquery-ui-1.12.min.js",
        ];

        $path = Yii::getPathOfAlias('vendor.studio-42.elfinder');
        $dir = $path;
        $assetsDir = Yii::app()->assetManager->publish($dir);

        $cs->registerCssFile($assetsDir . '/css/elfinder.min.css');
        $cs->registerCssFile($assetsDir . '/css/theme.css');
        $cs->registerScriptFile($assetsDir . '/js/elfinder.min.js');
        // elFinder translation
        $cs->registerScriptFile($assetsDir . '/js/i18n/elfinder.' . Yii::app()->language . '.js');
        // some css fixes
        Yii::app()->clientScript->registerCss('elfinder-file-bg-fixer', '.elfinder-cwd-file,.elfinder-cwd-file .elfinder-cwd-file-wrapper,.elfinder-cwd-file .elfinder-cwd-filename{background-image:none !important;} .ui-button.ui-button-icon-only{font-size: 0 !important} .ui-button .ui-button-icon{top: 0; left: 0;}');

        Yii::app()->getClientScript()->registerScriptFile($assetsfm.'/ckeditorElfinder.js');

        Yii::app()->getClientScript()->registerScript(__CLASS__, "
             $(document).off('click', '.cke_dialog_tabs a:eq(2)').on('click', '.cke_dialog_tabs a:eq(2)', function () {
                var \$form = $('.cke_dialog_ui_input_file iframe').contents().find('form');
                if (!\$form.find('input[name=' + yupeTokenName + ']').length) {
                    var csrfTokenInput = $('<input/>').attr({
                        'type': 'hidden',
                        'name': yupeTokenName
                    }).val(yupeToken);
                    \$form.append(csrfTokenInput);
                }
            });
            (function(){
                
                elFinderInit('{$elFinderConnect}');

                /*var elfNode, elfInsrance, dialogName,
                elfUrl        = '{$elFinderConnect}',
                elfDirHashMap = {};
                
                CKEDITOR.on('dialogDefinition', function (event) { // connection manager
                    var editor = event.editor;
                    var dialogDefinition = event.data.definition;
                    var tabCount = dialogDefinition.contents.length;
                    for (var i = 0; i < tabCount; i++) {
                        var browseButton = dialogDefinition.contents[i].get('browse');

                        if (browseButton !== null) {
                            browseButton.hidden = false;
                            browseButton.onClick = function (dialog, i) {

                                dialogName = CKEDITOR.dialog.getCurrent()._.name;
                                if (elfNode) {
                                    if (elfDirHashMap[dialogName] && elfDirHashMap[dialogName] != elfInsrance.cwd().hash) {
                                        elfInsrance.request({
                                            data   : {cmd  : 'open', target : elfDirHashMap[dialogName]},
                                            notify : {type : 'open', cnt : 1, hideCnt : true},
                                            syncOnFail : true
                                        });
                                    }
                                    elfNode.dialog('open');
                                } else {
                                    elfNode = $('<div \>');
                                    elfNode.dialog({
                                        modal: true,
                                        width: '80%',
                                        title: 'Server File Manager',
                                        create: function (event, ui) {
                                            var startPathHash = (elfDirHashMap[dialogName] && elfDirHashMap[dialogName])? elfDirHashMap[dialogName] : '';
                                            elfInsrance = $(this).elfinder({
                                                startPathHash: startPathHash,
                                                useBrowserHistory: false,
                                                resizable: false,
                                                width: '100%',
                                                url: elfUrl,
                                                getFileCallback: function (file) {
                                                    var url = file.url;
                                                    var dialog = CKEDITOR.dialog.getCurrent();
                                                    if (dialogName == 'image') {
                                                        var urlObj = 'txtUrl'
                                                    } else if (dialogName == 'flash') {
                                                        var urlObj = 'src'
                                                    } else if (dialogName == 'files' || dialogName == 'link') {
                                                        var urlObj = 'url'
                                                    } else {
                                                        return;
                                                    }
                                                    dialog.setValueOf(dialog._.currentTabId, urlObj, url);
                                                    elfNode.dialog('close');
                                                    elfInsrance.disable();
                                                }
                                            }).elfinder('instance');
                                        },
                                        open: function() {
                                            elfNode.find('div.elfinder-toolbar input').blur();
                                            setTimeout(function(){
                                                elfInsrance.enable();
                                            }, 100);
                                        },
                                        resizeStop: function() {
                                            elfNode.trigger('resize');
                                        }
                                    }).parent().css({'zIndex':'11000'});
                                }

                            }
                        }

                    }
                });*/
            })();
        ");

        Yii::app()->getClientScript()->registerScript(
            __CLASS__.'#'.$this->getId(),
            "CKEDITOR.replace( '$id', $options);"
        );
    }
}
