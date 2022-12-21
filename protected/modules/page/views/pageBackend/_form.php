<?php
/**
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this PageBackendController
 * @var $model Page
 * @var $form \yupe\widgets\ActiveForm
 */
?>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#menu_id').change(function () {
            var menuId = parseInt($(this).val());
            if (menuId) {
                $.post('<?= Yii::app()->createUrl('/menu/menuitemBackend/getjsonitems/') ?>', {
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>',
                    'menuId': menuId
                }, function (response) {
                    if (response.result) {
                        var option = false;
                        var current = <?= (int)$menuParentId; ?>;
                        $.each(response.data, function (index, element) {
                            if (index == current) {
                                option = true;
                            } else {
                                option = false;
                            }
                            $('#parent_id').append(new Option(element, index, option));
                        })
                        if (current) {
                            $('#parent_id').val(current);
                        }
                        $('#parent_id').removeAttr('disabled');
                        $('#pareData').show();
                    }
                });
            }
        });

        if ($('#menu_id').val() > 0) {
            $('#menu_id').trigger('change');
        }
    })
</script>

<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("PageModule.page", "General"); ?></a></li>
    <li><a href="#options" data-toggle="tab"><?= Yii::t("PageModule.page", "More options"); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t("PageModule.page", "Data for SEO"); ?></a></li>
    <li><a href="#photos" data-toggle="tab"><?= Yii::t("PageModule.page", "Галерея"); ?></a></li>
    <li><a href="#setting" data-toggle="tab"><?= Yii::t("PageModule.page", "Произвольные поля"); ?></a></li>
</ul>

<?php

$form = $this->beginWidget(
    'yupe\widgets\ActiveForm',
    [
        'id' => 'page-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>
<div class="alert alert-info">
    <?= Yii::t('PageModule.page', 'Fields with'); ?>
    <span class="required">*</span>
    <?= Yii::t('PageModule.page', 'are required.'); ?>
</div>

<?= $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="common">
        <?php if (Yii::app()->hasModule('menu')): { ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <?= CHtml::label(Yii::t('PageModule.page', 'Menu'), 'menu_id'); ?>
                        <?= CHtml::dropDownList(
                            'menu_id',
                            $menuId,
                            CHtml::listData(Menu::model()->active()->findAll(['order' => 'name DESC']), 'id', 'name'),
                            ['empty' => Yii::t('PageModule.page', '-choose-'), 'class' => 'form-control']
                        ); ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div id="pareData" style='display:none;'>
                            <?= CHtml::label(Yii::t('PageModule.page', 'Parent menu item'), 'parent_id'); ?>
                            <?= CHtml::dropDownList(
                                'parent_id',
                                $menuParentId,
                                ['0' => Yii::t('PageModule.page', 'Root')],
                                [
                                    'disabled' => true,
                                    'empty' => Yii::t('PageModule.page', '-choose-'),
                                    'class' => 'form-control'
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } endif ?>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'category_id',
                    [
                        'widgetOptions' => [
                            'data' => Yii::app()->getComponent('categoriesRepository')->getFormattedList($this->getModule()->mainCategory),
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('category_id'),
                                'data-content' => $model->getAttributeDescription('category_id'),
                                'encode' => false
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <?php if (count($languages) > 1) : { ?>
                <div class="col-sm-4">
                    <?= $form->dropDownListGroup(
                        $model,
                        'lang',
                        [
                            'widgetOptions' => [
                                'data' => $languages,
                                'htmlOptions' => [
                                    'class' => 'popover-help',
                                    'empty' => Yii::t('PageModule.page', '--choose--')
                                ],
                            ],
                        ]
                    ); ?>
                </div>
                <div class="col-sm-4">
                    <br/>
                    <?php if (!$model->isNewRecord) : { ?>
                        <?php foreach ($languages as $k => $v) : { ?>
                            <?php if ($k !== $model->lang) : { ?>
                                <?php if (empty($langModels[$k])) : { ?>
                                    <a href="<?= $this->createUrl(
                                        '/page/pageBackend/create',
                                        ['id' => $model->id, 'lang' => $k]
                                    ); ?>"><i class="iconflags iconflags-<?= $k; ?>"
                                              title="<?= Yii::t(
                                                  'PageModule.page',
                                                  'Add translation for {lang}',
                                                  ['{lang}' => $v]
                                              ); ?>"></i></a>
                                <?php } else : { ?>
                                    <a href="<?= $this->createUrl(
                                        '/page/pageBackend/update',
                                        ['id' => $langModels[$k]]
                                    ); ?>"><i class="iconflags iconflags-<?= $k; ?>"
                                              title="<?= Yii::t(
                                                  'PageModule.page',
                                                  'Edit translation for {lang} language',
                                                  ['{lang}' => $v]
                                              ); ?>"></i></a>
                                <?php } endif; ?>
                            <?php } endif; ?>
                        <?php } endforeach; ?>
                    <?php } endif; ?>
                </div>
            <?php } else : { ?>
                <?= $form->hiddenField($model, 'lang'); ?>
            <?php } endif; ?>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'status',
                    [
                        'widgetOptions' => [
                            'data' => $model->statusList,
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('status'),
                                'data-content' => $model->getAttributeDescription('status'),
                                'data-container' => 'body',
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->dropDownListGroup(
                    $model,
                    'parent_id',
                    [
                        'widgetOptions' => [
                            'data' => $pages,
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('parent_id'),
                                'data-content' => $model->getAttributeDescription('parent_id'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup(
                    $model,
                    'title_short',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'data-original-title' => $model->getAttributeLabel('title_short'),
                                'data-content' => $model->getAttributeDescription('title_short')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup(
                    $model,
                    'title',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'data-original-title' => $model->getAttributeLabel('title'),
                                'data-content' => $model->getAttributeDescription('title')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->slugFieldGroup(
                    $model,
                    'slug',
                    [
                        'sourceAttribute' => 'title',
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('slug'),
                                'data-content' => $model->getAttributeDescription('slug'),
                                'placeholder' => Yii::t(
                                    'PageModule.page',
                                    'For automatic generation leave this field empty'
                                ),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->checkBoxGroup(
                    $model,
                    'is_protected',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('is_protected'),
                                'data-content' => $model->getAttributeDescription('is_protected')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 popover-help" data-original-title='<?= $model->getAttributeLabel('body'); ?>'
                 data-content='<?= $model->getAttributeDescription('body'); ?>'>
                <?= $form->labelEx($model, 'body'); ?>
                <?php
                $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'body',
                    ]
                ); ?>
            </div>
        </div>

        <br>

        <div class='row'>
            <div class="col-sm-3">
                <?php
                echo CHtml::image(
                    !$model->isNewRecord && $model->image ? $model->getImageUrl(150, 150) : '#',
                    $model->title,
                    [
                        'class' => 'preview-image img-responsive',
                        'style' => !$model->isNewRecord && $model->image ? '' : 'display: none',
                    ]
                ); ?>

                <?php if (!$model->isNewRecord && $model->image): ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="delete-image"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                        </label>
                    </div>
                <?php endif; ?>

                <?= $form->fileFieldGroup(
                    $model,
                    'image',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'style' => 'background-color: inherit;',
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <br/>
    </div>

    <div class="tab-pane" id="options">

        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'layout',
                    [
                        'widgetOptions' => [
                            'data' => Yii::app()->getModule('yupe')->getLayoutsList(),
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('layout'),
                                'data-content' => $model->getAttributeDescription('layout'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-3">
                <?= CHtml::label($model->attributeLabels()['view'], ''); ?>
                <?= CHtml::dropDownList(
                    'Page[view]',
                    $model->view,
                    $model->getViewsLists(),
                    ['empty' => Yii::t('PageModule.page', '-choose-'), 'class' => 'form-control']
                ); ?>
            </div>

            <div class="col-sm-3">
                <?= $form->textFieldGroup(
                    $model,
                    'order',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('order'),
                                'data-content' => $model->getAttributeDescription('order'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="seo">

        <div class="row">
            <div class="col-sm-7">
                <?= $form->checkBoxGroup(
                    $model,
                    'noindex',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('noindex'),
                                'data-content' => $model->getAttributeDescription('noindex')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-7">
                <?= $form->textFieldGroup(
                    $model,
                    'meta_title',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('meta_title'),
                                'data-content' => $model->getAttributeDescription('meta_title'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-7">
                <?= $form->textFieldGroup(
                    $model,
                    'meta_keywords',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('meta_keywords'),
                                'data-content' => $model->getAttributeDescription('meta_keywords'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-7">
                <?= $form->textAreaGroup(
                    $model,
                    'meta_description',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'rows' => 8,
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('meta_description'),
                                'data-content' => $model->getAttributeDescription('meta_description'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="photos">
        <div id="photos">
            <style type="text/css">
                .image-wrapper{
                    width: 200px;
                    border: 1px solid #cecece;
                }
                .image-wrapper .gallery-thumbnail{
                    height: auto;
                }
                .gallery-thumbnail .move-sign{
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                }
                #chain-photos{
                    width:  auto;
                    text-align: center
                }
                .chain-photo{
                    position: relative;
                    display: block;
                    /*float: left;*/
                    margin: 5px;
                    position: relative;
                }
                .chain-photo .form-group label{
                    font-size: 12px;
                }
                .chain-photo__img{
                    position: relative;
                    height: 190px;
                    line-height: 190px;
                    padding: 0 0 10px;
                }
                .chain-photo__img img{
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

                .file-drop-zone{
                    margin-bottom: 5px;
                }

                .file-drop-zone-title{
                    padding: 30px 10px!important;

                }
                .file-preview{
                    margin-bottom: 0;
                    border: none;
                }
                .photo-add-input{
                    width: 100%;
                    text-align: center;
                    border-bottom: 1px solid rgba(0, 0, 0, 0.3);
                    margin: 0 0 40px;
                }
                .photo-add-input label{
                    display: block;
                    text-align: left;
                    padding: 0 0 5px;
                }

                .photo-add-input span{
                    font-size: 20px;
                    opacity: .5;
                    font-weight: 900;
                    position: absolute;
                    top: 5px;
                    right: 5px;
                }
                .photo-add-input .btn-file{
                    /*display: none;*/
                    margin: 15px 0 0;
                }
                .photo-add-input .hidden-xs{
                    font-size: 16px;
                    opacity: .5;
                    font-weight: 900;
                    position: static;
                }
                .photo-add-input .glyphicon-plus-sign:before{
                    display: none!important;
                }
            </style>
            <?php
            Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
            $mainAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('gallery.views.assets'));
            Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/gallery.css');
            Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/gallery-sortable.js', CClientScript::POS_END);

            Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/fileinput.min.css');
            Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/fileinput.min.js', CClientScript::POS_END);

            $this->widget('gallery.extensions.colorbox.ColorBox', [
                'target' => '.gallery-image',
                'config' => [ // тут конфиги плагина, подробнее http://www.jacklmoore.com/colorbox
                ],
            ]);
            Yii::app()->clientScript->registerScript("input", "
                    $('.photo-add-input').find('input').fileinput({
                         showCaption: false,
                         browseLabel: 'Выберите файл',
                         browseClass: 'btns',
                         dropZoneTitle:'Перетащите сюда ваши файлы <br>или',
                         removeLabel: 'Удалить',
                         uploadLabel:'Загрузить',
                         msgZoomModalHeading:'Детальный просмотр',
                         zoomTitle:'Детальный просмотр'
                         });
                ");
            $keys = [];
            ?>


            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="photo-add-input">
                            <label>Добавить изображения</label>
                            <?php echo CHtml::fileField("PageImage[][image]",'', ['multiple'=>true]); ?><br/>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$model->getIsNewRecord()): ?>
                <div id="gallery-wrapper">
                    <div class="row gallery-thumbnails thumbnails">
                        <?php foreach ($model->photos(['order' => 'position DESC']) as $image): ?>
                            <?php $keys[] = sprintf('<span data-order="%d">%d</span>', $image->position, $image->id); ?>
                            <div class="image-wrapper">
                                <div class="gallery-thumbnail">
                                    <div class="page-photo">
                                        <div class="page-photo__img">
                                            <div class="move-sign">
                                                <span class="fa fa-4x fa-arrows"></span>
                                            </div>
                                            <img src="<?= $image->getImageUrl(170, 170); ?>" alt=""/>
                                        </div>
                                        <div class="btn-group image-settings">
                                            <button type="button" class="btn btn-default page-delete-photo" data-id="<?= $image->id; ?>" href="<?= Yii::app()->createUrl('/page/pageBackend/deletePhoto', ['id' => $image->id]); ?>"><span class="fa fa-fw fa-times"></span></button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="collapse"
                                                    data-target="#image-settings<?= $image->id; ?>"><span class="fa fa-gear"></span></button>
                                            <div id="image-settings<?= $image->id; ?>" class="dropdown-menu">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <?= CHtml::textField('PageImage['.$image->id.'][title]', $image->title,['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <?= CHtml::textField('PageImage['.$image->id.'][alt]', $image->alt,['class' => 'form-control', 'placeholder' => 'Alt']) ?>
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
            <div class="sortOrder hidden"
                 data-token-name="<?= Yii::app()->getRequest()->csrfTokenName; ?>"
                 data-token="<?= Yii::app()->getRequest()->getCsrfToken(); ?>"
                 data-action="<?= Yii::app()->createUrl('/page/pageBackend/sortablephoto') ?>"
            >
                <?= implode('', $keys) ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="setting">
        <?php $this->renderPartial('_my-custom-field', ['model' => $model]) ?>
    </div>
</div>

<br/><br/>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('PageModule.page', 'Create page and continue') : Yii::t(
            'PageModule.page',
            'Save page and continue'
        ),
    ]
); ?>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->isNewRecord ? Yii::t('PageModule.page', 'Create page and close') : Yii::t(
            'PageModule.page',
            'Save page and close'
        ),
    ]
); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function () {
        $('.page-delete-photo').on('click', function (event) {
            event.preventDefault();
            var blockForDelete = $(this).closest('.image-wrapper');
            $.ajax({
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                },
                url: '<?= Yii::app()->createUrl('/page/pageBackend/deleteImage');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });
    });
    $(this).closest('.page-image').remove();
    $('#page-images').on('click', '.button-delete-image', function () {
        $(this).closest('.row').remove();
    });
</script>
