<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 *
 *   @var $model Review
 *   @var $form TbActiveForm
 *   @var $this ReviewBackendController
 **/
?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab">Общие</a></li>
    <li><a href="#photos" data-toggle="tab">Галерея</a></li>
</ul>
<?php 
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id'                     => 'review-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('ReviewModule.review', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('ReviewModule.review', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>
<div class="tab-content">
    <div class="tab-pane active" id="common">
        <?=  $form->hiddenField($model, 'validate', [
            'value' => "1"
        ]); ?>
        <div class="row">
            <div class="col-sm-7">
                <?php /*=  $form->dropDownListGroup($model, 'product_id', [
                    'widgetOptions' => [
                        'data' => $model->getProductList(),
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('product_id'),
                            'data-content' => $model->getAttributeDescription('product_id'),
                            'empty' => '--Выберите товар --'
                        ]
                    ]
                ]);*/ ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'username', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('username'),
                            'data-content' => $model->getAttributeDescription('username')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->dateTimePickerGroup($model,'date_created', [
                'widgetOptions' => [
                    'options' => [],
                    'htmlOptions'=>[]
                ],
                'prepend'=>'<i class="fa fa-calendar"></i>'
            ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textAreaGroup($model, 'text', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'rows' => 6,
                        'cols' => 50,
                        'data-original-title' => $model->getAttributeLabel('text'),
                        'data-content' => $model->getAttributeDescription('text')
                    ]
                ]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <!-- <label for="">Оценка работы (от 1 - 5)</label> -->
                <?=  $form->textFieldGroup($model, 'rating', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        "placeholder" => 'Оценка работы (от 1 - 5)',
                        'data-original-title' => $model->getAttributeLabel('rating'),
                        'data-content' => $model->getAttributeDescription('rating')
                    ],
                ]]); ?>
                <p class="hint" style="margin: -10px 0 20px; ">Оценка работы (от 1 - 5)</p>
            </div>
        </div>    
        <!-- <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'useremail', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('useremail'),
                            'data-content' => $model->getAttributeDescription('useremail')
                        ]
                    ]
                ]); ?>
            </div>
        </div> -->
        <!-- <div class='row'>
            <div class="col-sm-7">
                <?php
                echo CHtml::image(
                    !$model->isNewRecord && $model->image ? $model->getImageUrl(200,200) : '#',
                    $model->username,
                    [
                        'class' => 'preview-image',
                        'style' => !$model->isNewRecord && $model->image ? '' : 'display:none',
                    ]
                ); ?>
        
                <?php if (!$model->isNewRecord && $model->image): ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="delete-file"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                        </label>
                    </div>
                <?php endif; ?>
        
                <?= $form->fileFieldGroup($model, 'image'); ?>
            </div>
        </div> -->
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->dropDownListGroup($model, 'moderation', [
                    'widgetOptions' => [
                        'data' => $model->getModerationList(),
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('moderation'),
                            'data-content' => $model->getAttributeDescription('moderation')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="photos">
        <div id="photos">
            <style type="text/css">
                .image-wrapper{
                    border: 1px solid #cecece;
                }
                .gallery-thumbnail .move-sign{
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                }
                #page-photos{
                    width:  auto;
                    text-align: center
                }
                .page-photo{
                    display: block;
                    float: left;
                    margin: 5px;
                    position: relative;
                }
                .page-photo .form-group label{
                    font-size: 12px;
                }
                .page-photo__img{
                    position: relative;
                    padding: 0 0 10px;
                }
                .review-delete-photo{
                    position: absolute;
                    top:  5px;
                    right:  5px;
                }
                .review-delete-photo .fa-fw {
                    color: #fff;
                    font-size: 1.5em;
                    padding: 3px;
                    background: rgba(0, 0, 0, 0.3);
                }
            </style>
           <?php 
               Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
               $mainAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('gallery.views.assets'));
                Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/gallery.css');
                Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/gallery-sortable.js', CClientScript::POS_END);
                
                $this->widget('gallery.extensions.colorbox.ColorBox', [
                    'target' => '.gallery-image',
                    'config' => [ // тут конфиги плагина, подробнее http://www.jacklmoore.com/colorbox
                    ],
                ]);
                $keys = [];
                ?>
    
    
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Добавить изображения</label>
                            <?php echo CHtml::fileField("ReviewImage[][image]",'', ['multiple'=>true]); ?><br/>
                        </div>
                    </div>
                </div>
                <?php if (!$model->getIsNewRecord()): ?>
                    <div id="gallery-wrapper">
                        <div class="row gallery-thumbnails thumbnails">
                            <?php foreach ($model->images(['order' => 'position DESC']) as $image): ?>
                                <?php $keys[] = sprintf('<span data-order="%d">%d</span>', $image->position, $image->id); ?>
                                <div class="image-wrapper">
                                    <div class="gallery-thumbnail">
                                        <div class="page-photo">
                                            <div class="page-photo__img">
                                                <div class="move-sign">
                                                    <span class="fa fa-4x fa-arrows"></span>
                                                </div>
                                                <a data-id="<?= $image->id; ?>" href="<?= Yii::app()->createUrl(
                                                    '/review/ReviewBackend/deletePhoto',
                                                    ['id' => $image->id]
                                                ); ?>" class="pull-right review-delete-photo"><i class="fa fa-fw fa-times"></i></a>
                                                <img src="<?= $image->getImageUrl(170, 170); ?>" alt=""/>
                                            </div>
                                            <div class="form-group">
                                                <?= CHtml::textField('ReviewImage['.$image->id.'][title]', $image->title,['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                            </div>
                                            <div class="form-group">
                                                <?= CHtml::textField('ReviewImage['.$image->id.'][alt]', $image->alt,['class' => 'form-control', 'placeholder' => 'Alt']) ?>
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
                data-action="<?= Yii::app()->createUrl('/review/ReviewBackend/sortablephoto') ?>"
                >
                <?= implode('', $keys) ?>
            </div>
        </div>
    </div>
</div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('ReviewModule.review', 'Сохранить Отзыв и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('ReviewModule.review', 'Сохранить Отзыв и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function () {
        $('.review-delete-photo').on('click', function (event) {
            event.preventDefault();
            var blockForDelete = $(this).closest('.image-wrapper');
            $.ajax({
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                },
                url: '<?= Yii::app()->createUrl('/review/ReviewBackend/deleteImage');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });
    });
</script>