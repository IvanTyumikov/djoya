<?php
namespace yupe\widgets\editors;

use Yii;
use CInputWidget;
// use yupe\extensions\elFinder\ElFinderHelper;

/**
 * Class TinyMCE5
 * @package yupe\widgets\editors
 */
class TinyMCE5 extends \CInputWidget
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

        if($this->hasModel()){
            echo \CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
        }else{
            echo \CHtml::textArea($name, $this->value, $this->htmlOptions);
        }

        $this->registerClientScript($id);
    }

    /**
     * @param $id
     */
    public function registerClientScript($id)
    {
        // ElFinderHelper::registerAssets();

        $imageurl = Yii::app()->createUrl('/yupe/backend/AjaxUploadTinyMCE5');
        $elFinderConnect = Yii::app()->createUrl('/yupe/backend/ElFinderConnection');
        $options = [
            'selector' => "#{$id}",
            'language' => 'ru',
            'height' => "480",
            'plugins' => 'code importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons paste',
            'menubar' => '',
            'toolbar' => 'code undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment addContentBlock addNewGallery',
            // 'image_advtab' => true,
            /* без комплекта images_upload_url, вкладка загрузки не будет отображаться*/
            // 'images_upload_url' => "{$imageurl}",
            

              /* мы переопределяем обработчик загрузки по умолчанию для имитации успешной загрузки */
            'images_upload_handler' => "js:function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{$imageurl}');

                xhr.onload = function() {
                  var json;

                  if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                  }

                  json = JSON.parse(xhr.responseText);

                  if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                  }

                  success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('YUPE_TOKEN', yupeToken);

                xhr.send(formData);
            }",
            'relative_urls' => false,
            'remove_script_host' => true,
            'convert_urls' => true,
            'allow_script_urls' => true,
            'file_picker_callback' => "js:mceElf{$id}.browser",
            // 'images_upload_handler'=> 'js:mceElf.uploadHandler',
            'setup' =>  "js:function(editor) {
                editor.ui.registry.addButton('addContentBlock', {
                  text: 'Вставить блок',
                  tooltip: 'Вставить блок',
                  onAction: function (_) {
                    editor.insertContent('<div>[[w:ContentMyBlock|id=введите id]]</div>');
                  }
                });
                editor.ui.registry.addButton('addNewGallery', {
                  text: 'Вставить галерею',
                  tooltip: 'Вставить галерею',
                  onAction: function (_) {
                    editor.insertContent('<div>[[w:NewGallery|id=введите id]]</div>');
                  }
                });
            }",
        ];

        $assets = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('vendor').'/tinymce/tinymce/'
        );
        $assetsfm = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('application.modules.yupe.views.assets.js')
        );

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerCssFile($cs->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');


        $cs->scriptMap = array(
            // 'jquery.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            // 'jquery.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            'jquery-ui.js' => "{$assetsfm}/jquery-ui-1.12.min.js",
            'jquery-ui.min.js' => "{$assetsfm}/jquery-ui-1.12.min.js",
        );

        $path = Yii::getPathOfAlias('vendor.studio-42.elfinder');
        $dir = $path;
        $assetsDir = Yii::app()->assetManager->publish($dir);

        $cs->registerCssFile($assetsDir . '/css/elfinder.min.css');
        $cs->registerCssFile($assetsDir . '/css/theme.css');
        $cs->registerScriptFile($assetsDir . '/js/elfinder.min.js');
        // elFinder translation
        $cs->registerScriptFile($assetsDir . '/js/i18n/elfinder.' . Yii::app()->language . '.js');
        // some css fixes
        Yii::app()->clientScript->registerCss('elfinder-file-bg-fixer', '.elfinder-cwd-file,.elfinder-cwd-file .elfinder-cwd-file-wrapper,.elfinder-cwd-file .elfinder-cwd-filename{background-image:none !important;}.tox-tinymce{margin-bottom:15px;}');

       

        Yii::app()->getClientScript()->registerScriptFile($assets.'/tinymce.min.js');
        Yii::app()->getClientScript()->registerScriptFile($assetsfm.'/tinymceElfinder.js');

        $options = \CJavaScript::encode(\CMap::mergeArray($options, $this->editorOptions));

        Yii::app()->getClientScript()->registerScript(
            __CLASS__.'#'.$this->getId(), "
            const mceElf{$id} = new tinymceElfinder({
                // connector URL (Set your connector)
                url: '{$elFinderConnect}',
                lang : 'ru',
                commands : [
                    'archive', 'back', 'chmod', 'colwidth', 'copy', 'cut', 'download', 'duplicate', 'edit', 'extract',
                    'forward', 'fullscreen', 'getfile', 'help', 'home', 'info', 'mkdir', 'mkfile', 'netmount', 'netunmount',
                    'open', 'opendir', 'paste', 'places', 'quicklook', 'reload', 'rename', 'resize', 'restore', 'rm',
                    'search', 'sort', 'up', 'upload', 'view', 'zipdl'
                ],
                // upload target folder hash for this tinyMCE
                // uploadTargetHash: 'l3_TUNFX0ltZ3M', // l3 MCE_Imgs
                // elFinder dialog node id
                // nodeId: 'elfinder' // Any ID you decide
            });
            tinymce.init({$options});
        ");
    }
}
