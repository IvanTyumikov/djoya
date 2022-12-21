<?php

use yupe\components\controllers\FrontController;

/**
 * Class ProductController
 */
class ProductController extends FrontController
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var AttributeFilter
     */
    protected $attributeFilter;

    /**
     *
     */
    public function init()
    {
        $this->productRepository = Yii::app()->getComponent('productRepository');
        $this->attributeFilter = Yii::app()->getComponent('attributesFilter');

        parent::init();
    }

    /**
     *
     */
    public function actionIndex()
    {
        $typesSearchParam = $this->attributeFilter->getTypeAttributesForSearchFromQuery(Yii::app()->getRequest());

        $mainSearchParam = $this->attributeFilter->getMainAttributesForSearchFromQuery(
            Yii::app()->getRequest(),
            [
                AttributeFilter::MAIN_SEARCH_PARAM_NAME => Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)
            ]
        );

        $view = 'index';

        if (!empty($mainSearchParam) || !empty($typesSearchParam)) {
            $data = $this->productRepository->getByFilter($mainSearchParam, $typesSearchParam);
        } else {
            $data = $this->productRepository->getListForIndexPage();
        }
        
        if(!empty(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME))){
            $view = 'search';
        }

        $this->render(
            $view,
            [
                'dataProvider' => $data,
            ]
        );
    }

    /**
     * @param string $name Product slug
     * @param string $category Product category path
     * @throws CHttpException
     */
    public function actionView($name, $category = null)
    {
        $product = $this->productRepository->getBySlug(
            $name,
            [
                'type.typeAttributes',
                'category',
                'variants',
                'attributesValues',
            ]
        );

        if (null === $product || $category !== null) {
            throw new CHttpException(404, Yii::t('StoreModule.catalog', 'Product was not found!'));
        }

        Yii::app()->eventManager->fire(StoreEvents::PRODUCT_OPEN, new ProductOpenEvent($product));

        $product->visits = $product->visits + 1;
        $product->save();

        $this->render($product->view ?:'view', ['product' => $product]);
    }


    public function actionProduct($id)
    {
        $product = Product::model()->findByPk($id);
        $view = 'modal';

        if(Yii::app()->getRequest()->getPost('productView')){
            $view = Yii::app()->getRequest()->getPost('productView');
        }

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('ajax/'.$view, [
                'product' => $product,
            ]);
            Yii::app()->end();
        } else {
            throw new CHttpException(404, Yii::t('StoreModule.catalog', 'Product was not found!'));
        }
    }

    //Загрузка изображений в зависимости от выбранного цвета
    public function actionImagesColor()
    {
        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getIsAjaxRequest()) {
            $id = (int)Yii::app()->getRequest()->getPost('productId');
            $product = Product::model()->findByPk($id);
            $optionId = (int)Yii::app()->getRequest()->getPost('variantId');
            $view = Yii::app()->getRequest()->getPost('view');
            
            if (null !== $product) {
                $this->renderPartial('ajax/'.$view, [
                    'product' => $product,
                    'optionId' => $optionId,
                ]);
                Yii::app()->end();
            } else {
                throw new CHttpException(404, Yii::t('StoreModule.catalog', 'Product was not found!'));
            }
        } else {
            throw new CHttpException(404, Yii::t('StoreModule.catalog', 'Product was not found!'));
        }
    }


    // Проверка наличия города в url
    public function showBottomText($showText = true)
    {
        $current_url = explode('/', $_SERVER['REQUEST_URI']);
        $slugs = Yii::app()->getDb()->createCommand()
                ->setFetchMode(PDO::FETCH_COLUMN, 0)
                ->from('{{city}}')
                ->select('slug')
                ->queryAll();
        if(in_array($current_url[1], $slugs)){
            if ($showText == true) {
                return $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
                    'id' => 8
                ]);                
            }
            return true;
        }
        return false;
    }
}