<?php

Yii::import('application.modules.store.models.*');

class AjaxProductWidget extends yupe\widgets\YWidget
{   
    
    public $view = 'view';

    protected $productRepository;
    protected $attributeFilter;

    public function init()
    {
        $this->productRepository = Yii::app()->getComponent('productRepository');
        $this->attributeFilter = Yii::app()->getComponent('attributesFilter');

        parent::init();
    }

    public function run()
    {

        $typesSearchParam = $this->attributeFilter->getTypeAttributesForSearchFromQuery(Yii::app()->getRequest());

                
        $mainSearchParam = $this->attributeFilter->getMainAttributesForSearchFromQuery(
            Yii::app()->getRequest(),
            [
                AttributeFilter::MAIN_SEARCH_PARAM_NAME => Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME),
            ]
        );       

        if (!empty($mainSearchParam) || !empty($typesSearchParam)) {
            $data = $this->productRepository->getByFilterAjaxProduct($mainSearchParam, $typesSearchParam, 'visits DESC');
        } else {
            $data = $this->productRepository->getListForIndexPage();
        }

        $this->render(
            $this->view,
            [
                'dataProvider' => $data,
            ]
        );
    }
}