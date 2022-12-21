<?php
Yii::import('bootstrap.widgets.TbListView');
/**
 * FtListView
 */
class FtListView extends TbListView
{

    public function registerClientScript()
    {
        $id=$this->getId();

        if ($this->ajaxUpdate===false) {
            $ajaxUpdate=[];
        } else {
            $ajaxUpdate=array_unique(preg_split('/\s*,\s*/', $this->ajaxUpdate.','.$id, -1, PREG_SPLIT_NO_EMPTY));
        }
        $options=[
            'ajaxUpdate'=>$ajaxUpdate,
            'ajaxVar'=>$this->ajaxVar,
            'pagerClass'=>$this->pagerCssClass,
            'loadingClass'=>$this->loadingCssClass,
            'sorterClass'=>$this->sorterCssClass,
            'enableHistory'=>$this->enableHistory
        ];
        if ($this->ajaxUrl!==null) {
            $options['url']=CHtml::normalizeUrl($this->ajaxUrl);
        }
        if ($this->ajaxType!==null) {
            $options['ajaxType']=strtoupper($this->ajaxType);
        }
        if ($this->updateSelector!==null) {
            $options['updateSelector']=$this->updateSelector;
        }
        foreach (['beforeAjaxUpdate', 'afterAjaxUpdate', 'ajaxUpdateError'] as $event) {
            if ($this->$event!==null) {
                if ($this->$event instanceof CJavaScriptExpression) {
                    $options[$event]=$this->$event;
                } else {
                    $options[$event]=new CJavaScriptExpression($this->$event);
                }
            }
        }

        // $options=CJavaScript::encode($options);
        $cs=Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScript(__CLASS__.'#'.$id, "
            $(document).delegate('.{$options['pagerClass']} a', 'click', function() {
                var item = $(this);
                var url = item.attr('href');
                var targetSelector = '#{$id} > .{$this->itemsCssClass}';
                var pagerSelector = '.{$options['pagerClass']}'
                var data = {};
                data['{$options['ajaxVar']}'] = '{$id}';
                $.ajax({
                    url: url,
                    type: 'get',
                    data: data,
                    success: function(data) {
                        var items = findInParsed(data, targetSelector).html();
                        if (items) {
                            $(targetSelector).append(items);
                        }

                        var pager = findInParsed(data, pagerSelector).html();
                        $(pagerSelector).html(pager);

                        // $('.raiting-list input').rating({'starWidth':'16','readOnly':true});
                        var scroll = $('#specialist-list');

                        function findInParsed(html, selector){
                            var check = $(selector, html).get(0);
                            if(check)
                                return $(check);
                            check = $(html).filter(selector).get(0)
                            return (check)? $(check) : false;
                        }
                    }
                });
                return false;
            });
            ");
        // $cs->registerCoreScript('bbq');
        // if ($this->enableHistory) {
        //     $cs->registerCoreScript('history');
        // }
        $cs->registerScriptFile($this->baseScriptUrl.'/jquery.yiilistview.js', CClientScript::POS_END);
        // $cs->registerScript(__CLASS__.'#'.$id, "jQuery('#$id').yiiListView($options);");
    }
}
