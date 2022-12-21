<?php
Yii::import('bootstrap.widgets.TbListView');
/**
 * MyListView
 */
class MyListView extends TbListView
{
    public $pager = array('class' => 'booster.widgets.TbPager');
    public $countProduct = '';

    public $sorterDropDown = [];
    public $sorterClassUl = '';
    public $sorterClassLink = 'sort-box__link';

    /* Формируем панель контроля для сортировки и смены вида отображения товаров */
    public function renderControls()
    {
        echo '
            <div class="but-menu-filter">
                <a class="button-mobile-filter" href="#"><span>Фильтры</span>
                </a>
            </div>
            <div class="catalog-controls">
                <div class="catalog-controls__sort"> ';
                    $this->renderSorter();
        echo '
            </div>';
                    $this->renderSummary();
        echo '
                <div class="catalog-controls__res">
                    <div class="template-product">
                        <div data-view="_item" class="template-product__item template-product__grid '.($this->controller->storeItem == "_item" ? "active" : "" ).'">'. file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/store/product-grid.svg') .'
                        </div>
                        <div data-view="_item-list" class="template-product__item template-product__list ' . ($this->controller->storeItem == "_item-list" ? "active" : "" ).'">' . file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/store/product-list.svg') .'
                        </div>
                    </div>
                </div>
            </div>';
    }

    public function renderSummary()
    {
        if(($count=$this->dataProvider->getItemCount())<=0)
            return;

        echo CHtml::openTag($this->summaryTagName, array('class'=>$this->summaryCssClass));
        if($this->enablePagination)
        {
            $pagination=$this->dataProvider->getPagination();

            $total=$this->dataProvider->getTotalItemCount();
            $start=$pagination->currentPage*$pagination->pageSize+1;
            $end=$start+$count-1;
            if($end>$total)
            {
                $end=$total;
                $start=$end-$count+1;
            }
            if(($summaryText=$this->summaryText)===null)
                $summaryText=Yii::t('zii','Товаров на странице: <strong class="pager-choice">{start}-{end} из {count}</strong>',$total);
            echo strtr($summaryText,array(
                '{start}'=>$start,
                '{end}'=>$end,
                '{count}'=>$total,
                '{page}'=>$pagination->currentPage+1,
                '{pages}'=>$pagination->pageCount,
            ));
        }
        else
        {
            if(($summaryText=$this->summaryText)===null)
                $summaryText=Yii::t('zii','Total 1 result.|Total {count} results.',$count);
            echo strtr($summaryText,array(
                '{count}'=>$count,
                '{start}'=>1,
                '{end}'=>$count,
                '{page}'=>1,
                '{pages}'=>1,
            ));
        }
        echo CHtml::closeTag($this->summaryTagName);
    }

    public function renderCountPage()
    {
        echo $this->countPage();
    }

    public function countPage()
    {
        $pageList = [24, 48, 72];
        $pageL = "<div class='countItem-box'>
            <div class='countItem-box__header'>Показывать по </div>
            <div class='countItem-box__body countItem-wrapper'>";

        foreach ($pageList as $key => $data) {
            $pageL .= "<div class='countItem-wrapper__link " . (($data == $this->controller->storeCountPage) ? 'active' : '') . "' data-count='{$data}'>{$data}</div>";
        }
        $pageL .= "</div></div>";
        return $pageL;
    }

    public function renderSorter()
    {
        $id = $this->htmlOptions['id'];
        $defaultSort = Yii::app()->getModule('store')->getDefaultSort('');
        $defaultSort = trim(preg_replace('/[^a-zA-Z](DESC|ASC|)/', ' ', $defaultSort));

        echo CHtml::openTag('div', ['class'=>$this->sorterCssClass])."\n";
            echo $this->sorterHeader===null ? Yii::t('zii','Sort by: ') : $this->sorterHeader;
            echo CHtml::openTag('ul', ['class' => $this->sorterClassUl])."\n";
            foreach ($this->sorterDropDown as $key => $item) {
                if($defaultSort == trim(preg_replace('/[^a-zA-Z](desc|asc|)/', ' ', $key))){
                    echo CHtml::openTag('li', ['class' => $this->sorterClassLink . ' active', 'data-href' => '?sort='.$key]);
                } else {
                    echo CHtml::openTag('li', ['class' => $this->sorterClassLink, 'data-href' => '?sort='.$key]);
                }
                    echo $item;
                echo CHtml::closeTag('li');
            }
            echo CHtml::closeTag('ul');
        echo CHtml::closeTag('div');

        Yii::app()->clientScript->registerScript('search', "
        $(document).delegate('.{$this->sorterClassLink}', 'click', function(){
            var elem = $(this);
            $('.catalog-content__pr-items').addClass('ajax-load');
            $.ajax({
                url: elem.attr('data-href'),
                success:function(data) {
                    $('.{$this->sorterClassLink}').removeClass('active');
                    if($('.{$this->itemsCssClass}').children().hasClass('product-box')){
                        $('.{$this->itemsCssClass}').html($(data).find('.product-box'));
                    }

                    if($('.{$this->itemsCssClass}').children().hasClass('product-list__item')){
                        $('.{$this->itemsCssClass}').html($(data).find('.product-list__item'));
                    }

                    if($('.{$this->itemsCssClass}').children().hasClass('product-list-big__item')){
                        $('.{$this->itemsCssClass}').html($(data).find('.product-list-big__item'));
                    }
                    elem.addClass('active');
                    $('.catalog-content__pr-items').removeClass('ajax-load');
                }
            });
            return false;
        });
        ");
    }
}


