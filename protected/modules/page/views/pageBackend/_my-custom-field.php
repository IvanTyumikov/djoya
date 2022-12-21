<style type="text/css">
    .imageField-wrapper{
        position: relative;
        /*float: left;*/
        text-align: center;
        /*width: 300px;*/
        /*margin: 0 5px 10px;*/
        padding: 0 !important;
        border: 1px solid #cecece;
    }
    .imageField-wrapper .gallery-thumbnail{
        height: auto;
    }
    .gallery-thumbnail .move-sign{
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    .field-photo{
        position: relative;
        display: block;
        /*float: left;*/
        margin: 5px;
        position: relative;
    }
    .field-photo .form-group label{
        font-size: 12px;
    }
    .field-photo__img{
        position: relative;
        height: 190px;
        /*line-height: 190px;*/
        /*padding: 0 0 10px;*/
        background: rgba(0, 0, 0, 0.1);
    }
    .field-photo__img img{
        max-width: 100%;
        max-height: 100%;
    }
    .image-settings .btn{
        width: 30px;
        height: 30px;
        margin: 0;
        float: none;
        padding: 0;
        border-radius: 5px !important;
    }
    .image-settings .row{
        padding: 5px 0;
    }
    /* .js-customfield-delete-img{
        position: absolute;
        top:  5px;
        right:  5px;
        z-index: 111;
    }
    .js-customfield-delete-img .fa-fw {
        color: #fff;
        font-size: 1.5em;
        padding: 3px;
        background: rgba(0, 0, 0, 0.3);
    } */
</style>
<?php 
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
    
    Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
    $mainAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('gallery.views.assets'));
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/gallery.css');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/gallery-sortable.js', CClientScript::POS_END);
    
    $keysField = [];
?>

<div class="row form-group">
    <div class="col-sm-6">
        <label>Произвольное поле: </label>
        <button id="button-add-myfield" type="button" class="btn btn-default">
            <i class="fa fa-fw fa-plus"></i>
        </button>
    </div>
</div>
<div class="row js-myfield-row" data-key="<?= (!empty($model->data) ? count($model->data) : 0); ?>">
    <div class="col-xs-12">
        <div id="myfield-section">
            <div class="myfield-template hidden form-group js-myfield">
                <div class="row">
                    <div class="col-xs-5 col-sm-5">
                        <label for="">Название</label>
                        <input type="text" class="myfield-name form-control"/>
                    </div>
                    <div class="col-xs-3 col-sm-3">
                        <label for="">Code</label>
                        <input type="text" class="myfield-code form-control"/>
                    </div>
                    <div class="col-xs-3 col-sm-3">
                        <label for="">Выберите редактор</label>
                        <?= CHtml::dropDownList('', '', [
                                'CodeMirror' => 'Обычное поле',
                                'Redactor' => 'Редактор',
                            ],
                            [
                                'class' => 'form-control myfield-template-dropdown js-template-dropdown',
                            ]
                        ) ?>
                    </div>

                    <div class="col-xs-11 col-sm-11">
                        <label for="">Значение</label>
                        <div class="js-template-field">
                            <textarea class="myfield-value form-control"></textarea> 
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1" style="padding-top: 24px">
                        <button class="button-delete-field btn btn-default" type="button">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Изображение</label>
                            <input type="file" class="myfield-image form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Добавить галерею</label>
                            <input multiple="multiple" type="file" class="myfield-gallery form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($model->data): ?>
            <div class="panel-group">
                <div class="panel panel-default" style="border: none;background-color: transparent;">
                    <?php foreach ($model->data as $key=>$data): ?>
                        <div class="js-myfield" data-key="<?= $key; ?>">
                            <div class="panel-heading" style="background: #fff; margin: 0 0 10px; border: 1px solid #ccc">
                                <div class="panel-title">
                                    <a class="" data-toggle="collapse" href="#customfieldcollapse<?= $key; ?>">
                                        <h5 style="display: flex; justify-content: space-between; font-size: 16px; padding: 0 10px;">
                                            <strong><?= $data['name']; ?></strong>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </h5>
                                    </a>
                                </div>
                            </div>
                            <div id="customfieldcollapse<?= $key; ?>" class="panel-collapse collapse js-collapse-open">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5">
                                                <label for="">Название</label>
                                                <?= CHtml::textField('MyCustomField['.$key.'][name]', $data['name'],
                                                    ['class' => 'form-control']) ?>
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <label for="">Code</label>
                                                <?= CHtml::textField('MyCustomField['.$key.'][code]', $data['code'],
                                                    ['class' => 'form-control']) ?>
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <label for="">Выберите редактор</label>
                                                <?= CHtml::dropDownList('MyCustomField['.$key.'][template]', $data['template'], [
                                                        'CodeMirror' => 'Обычное поле',
                                                        'Redactor' => 'Редактор',
                                                    ],
                                                    [
                                                        'class' => 'form-control myfield-template-dropdown js-template-dropdown',
                                                    ]
                                                ) ?>
                                            </div>
                                            <div class="col-xs-11 col-sm-11">
                                                <label for="">Значение</label>
                                                <div class="js-template-field">
                                                    <?php if($data['template'] == 'Redactor') : ?>
                                                        <?php $this->widget( $this->yupe->getVisualEditor(),[
                                                            'name' => 'MyCustomField['.$key.'][value]',
                                                            'value' => $data['value']                                                  
                                                        ]); ?>
                                                    <?php else : ?>
                                                        <?= CHtml::textArea('MyCustomField['.$key.'][value]', $data['value'], [
                                                            'class' => 'form-control mytextareaVal'
                                                        ]) ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-1 col-sm-1" style="padding-top: 24px">
                                                <button class="btn btn-danger button-delete-myfield">
                                                    <i class="fa fa-fw fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class="col-sm-8">
                                                <br>
                                                <?php if(!empty($data['image'])) : ?>
                                                    <?= CHtml::hiddenField('MyCustomField['.$key.'][image]', $data['image']) ?>
                                                    <?php
                                                    echo CHtml::image($model->getFieldImageUrl(200,200,false,$data['image']),
                                                        '',
                                                        [
                                                            'class' => 'preview-image',
                                                        ]
                                                    ); ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="myCustomField-delete-image-<?= $key;?>"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                                <label>Изображение</label>
                                                <input type="file" class="form-control" name="MyCustomField_<?= $key; ?>[image]">
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class="col-sm-12">
                                                <label>Добавить галерею</label>
                                                <input type="file" multiple="multiple" class="form-control" name="MyCustomFieldGallery_<?= $key; ?>[]">
                                                <br>
                                                <?php if(!empty($data['gallery'])) : ?>
                                                    <div id="galleryField-wrapper">
                                                        <code>
                                                            Скопируйте этот код для вставки галереи: [[w:CustomField|id=<?= $model->id; ?>;code=<?= $data['code']; ?>]]
                                                        </code>
                                                        <div><br></div>
                                                        <div class="row galleryField-thumbnails thumbnails">
                                                        <?php foreach ($data['gallery'] as $key2 => $images) :?>
                                                            <?php $keysField[] = sprintf('<span data-order="%d">%d</span>', $key2+1, $key.$key2); ?>
                                                            <div class="col-md-3 col-sm-4 col-xs-6 imageField-wrapper" data-pos="<?= $key.$key2; ?>">
                                                                <div class="gallery-thumbnail">
                                                                    <?= CHtml::hiddenField('MyCustomField['.$key.'][gallery]['.$key2.'][image]', $images['image']) ?>
                                                                    <?= CHtml::hiddenField('MyCustomField['.$key.'][gallery]['.$key2.'][position]', $images['position'], ['class' => 'js-customField-pos-images']) ?>
                                                                    <div class="hidden">
                                                                        <input type="checkbox" name="myCustomField-delete-galImage-<?= $key.'_'.$key2;?>"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                                                                    </div>
                                                                    <div class="field-photo">
                                                                        <div class="field-photo__img">
                                                                            <div class="move-sign">
                                                                                <span class="fa fa-4x fa-arrows"></span>
                                                                            </div>
                                                                            <?php if(!empty($model->getFieldGalImageUrl(170,170,false,$images['image']))) : ?>
                                                                                <?= CHtml::image($model->getFieldGalImageUrl(170,170,false,$images['image']), '', ['class' => 'preview-image']); ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="btn-group image-settings">
                                                                            <button type="button" class="btn btn-default js-customfield-delete-img" data-id="<?= $image->id; ?>"><span class="fa fa-fw fa-times"></span></button>
                                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="collapse"
                                                                                    data-target="#image-settings<?= $key.'-'.$key2; ?>"><span class="fa fa-gear"></span></button>
                                                                            <div id="image-settings<?= $key.'-'.$key2; ?>" class="dropdown-menu">
                                                                                <div class="container-fluid">
                                                                                    <div class="row">
                                                                                        <div class="col-xs-12">
                                                                                            <?= CHtml::textField('MyCustomField['.$key.'][gallery]['.$key2.'][title]', $images['title'],['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xs-12">
                                                                                            <?= CHtml::textField('MyCustomField['.$key.'][gallery]['.$key2.'][alt]', $images['alt'],['class' => 'form-control', 'placeholder' => 'Alt']) ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row hidden">
                                                                                        <div class="col-xs-12">
                                                                                            <?= CHtml::textArea('MyCustomField['.$key.'][gallery]['.$key2.'][description]', $images['description'],['class' => 'form-control', 'placeholder' => 'Описание', 'rows' => 10]) ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="sortOrderField hidden"
            data-token-name="<?= Yii::app()->getRequest()->csrfTokenName; ?>"
            data-token="<?= Yii::app()->getRequest()->getCsrfToken(); ?>"
            data-action="<?= Yii::app()->createUrl('/directions/directionsBackend/sortablephoto') ?>"
            >
            <?= implode('', $keysField) ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*
     * Создаем новое произвольное поле
    */
    $(document).delegate('#button-add-myfield', 'click', function () {
        var newfield = $("#myfield-section .myfield-template").clone().removeClass('myfield-template').removeClass('hidden');
        // var key = $.now();
        // var key = $(".js-myfield-row").find('.js-myfield').length;
        var key = updatePositionCustomField();
        key = parseInt(key) + 1;

        newfield.prependTo("#myfield-section");
        newfield.find(".myfield-name").attr('name', 'MyCustomField[' + key + '][name]');
        newfield.find(".myfield-code").attr('name', 'MyCustomField[' + key + '][code]');
        newfield.find(".myfield-value").attr('name', 'MyCustomField[' + key + '][value]');
        newfield.find(".myfield-template-dropdown").attr('name', 'MyCustomField[' + key + '][template]');
        newfield.find(".myfield-image").attr('name', 'MyCustomField_' + key + '[image]');
        newfield.find(".myfield-gallery").attr('name', 'MyCustomFieldGallery_' + key + '[]');

        updateCodemirror(newfield.find(".myfield-value")[0], 250);

        newfield.attr('data-key', key);
        $(".js-myfield-row").attr('data-key', key);
        return false;
    });
   
    /*
     * Удаляем не сохраненное произвольное поле
    */
    $('#myfield-section').on('click', '.button-delete-field', function () {
        $(this).closest('.js-myfield').remove();   
        var key = updatePositionCustomField();
        key = parseInt(key) - 1;
        $(".js-myfield-row").attr('data-key', key);
    });
    /*
     * Удаляем сохраненное произвольное поле и обновляем сортировку
    */
    $('.button-delete-myfield').on('click', function () {
        $(this).parents('.js-myfield').remove();
    
        var key = updatePositionCustomField();
        key = parseInt(key) - 1;
        $(".js-myfield-row").attr('data-key', key);
        return false;
    });


    /*
     * Инициализируем все Codemirror во вкладке
    */
    $('.nav-tabs a').on('shown.bs.tab', function() {
        refreshCodemirror($($(this).attr('href')));
    });
    $('.js-collapse-open').on('shown.bs.collapse', function() {
        refreshCodemirror($(this));
    });
    /*
     * Инициализируем Codemirror при загрузке страницы
    */
    $('.mytextareaVal').each(function(){
        updateCodemirror($(this)[0]);
    });

    /*
     * Меняем шаблон значения(value)
    */
    $(document).delegate('.js-template-dropdown', 'change', function (event) {
        event.preventDefault();
        var parent = $(this).parents('.js-myfield').find('.js-template-field');
        var template = $(this).find('option:selected').val();

        if(template == 'CodeMirror'){
            parent.html(parent.find("textarea")[0]);
            updateCodemirror(parent.find("textarea")[0], 250);
        } else {
            parent.find("textarea").redactor({'toolbarFixed':true,'buttonSource':true,'imageUpload':'\x2Fbackend\x2FAjaxImageUpload','fileUpload':'\x2Fbackend\x2FAjaxFileUpload','imageManagerJson':'\x2Fbackend\x2Fimage\x2Fimage\x2FAjaxImageChoose','fileUploadErrorCallback':function (data) {
                $('#notifications').notify({
                    message: {text: data.error},
                    type: 'danger',
                    fadeOut: {delay: 5000}
                }).show();
                },'imageUploadErrorCallback':function (data) {
                $('#notifications').notify({
                    message: {text: data.error},
                    type: 'danger',
                    fadeOut: {delay: 5000}
                }).show();
                },'toolbarFixedTopOffset':53,'lang':'ru','minHeight':150,
                    'uploadImageFields':{'<?= Yii::app()->getRequest()->csrfTokenName;?>':'<?= Yii::app()->getRequest()->csrfToken;?>'},
                    'uploadFileFields':{'<?= Yii::app()->getRequest()->csrfTokenName;?>':'<?= Yii::app()->getRequest()->csrfToken;?>'},
                    'replaceDivs':false,
                    'plugins':['video','fullscreen','table','fontsize','fontfamily','fontcolor','imagemanager']
                });
            parent.find('.CodeMirror').remove();
        }    
    });

    /*
     * Функция обновления key нового шаблона
    */
    function updatePositionCustomField(){
        var key = 0;
        $('.js-myfield').each(function(){
            var fieldkey = $(this).data('key');
            if(key < parseInt(fieldkey)){
                key = parseInt(fieldkey);
            }
        });
        return key;
    }
    /*
     * Функция инициализации Codemirror
    */
    function updateCodemirror(elem,height=300){
        var editorVal = CodeMirror.fromTextArea(elem, {
            lineNumbers: true,
            lineWrapping: true,
            mode: 'text/html',
            keyMap: 'sublime',
            theme: 'monokai',
            matchBrackets: true
        });
        editorVal.setSize(null, height);
        emmetCodeMirror(editorVal);
    }
    /*
     * Функция обновления Codemirror
    */
    function refreshCodemirror(elem) {
        elem.find(".CodeMirror").each(function(){
            var codeMirrorContainer = $(this)[0];
            if (codeMirrorContainer && codeMirrorContainer.CodeMirror) {
                codeMirrorContainer.CodeMirror.refresh();
            }
        });
    }

    $(document).delegate('.js-customfield-delete-img', 'click', function (event) {
        var parent  = $(this).parents('.imageField-wrapper');
        parent.find('input[type=checkbox]').prop('checked', true);
        parent.addClass('hidden');

        return false;
    });

    $(document).ready(function () {
        var originalPosField = null;
        var dataFiled = {};
        var keysElField = $('.sortOrderField');
        dataFiled[keysElField.data('token-name')] = keysElField.data('token');

        var sortableHelperField = function (a, el) {
            originalPosField = el.prevAll().length;
            var helper = el.clone();

            return helper;
        };

        $('.galleryField-thumbnails').sortable({
            helper: sortableHelperField,
            update: function (event, ui) {
                var pos = $(ui.item).prevAll().length;

                if (originalPosField !== null && originalPosField != pos) {
                    var keys = keysElField.children('span');
                    var key = keys.eq(originalPosField);
                    var sort = [];

                    keys.each(function (i) {
                        sort[i] = $(this).attr('data-order');
                    });

                    if (originalPosField < pos) {
                        keys.eq(pos).after(key);
                    }
                    if (originalPosField > pos) {
                        keys.eq(pos).before(key);
                    }
                    originalPosField = null;
                }
                var sortOrder = {};
                keys = keysElField.children('span');
                keys.each(function (i) {
                    $(this).attr('data-order', sort[i]);
                    sortOrder[$(this).text()] = sort[i];
                });

                dataFiled["sortOrder"] = sortOrder;
                console.log(dataFiled["sortOrder"]);
                for(var it in sortOrder) {
                    var value = sortOrder[it];
                    var block = $('.imageField-wrapper[data-pos='+it+']');
                    // var block_val = block.find('.js-customField-pos-images').val();

                    block.find('.js-customField-pos-images').val(value);
                }

                /*$.ajax({
                    type: "POST",
                    url: keysElField.data('action'),
                    data: dataFiled
                });*/
            }
        });
    });
</script>