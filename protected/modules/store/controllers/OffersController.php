<?php
use yupe\components\controllers\FrontController;

/**
 * Class OffersController
 */
class OffersController extends FrontController
{
    public function actionIndex($id)
    {
        $data = Yii::app()->session['offers'];
        if (isset($data[$id])) {
            unset($data[$id]);
        } else {
            $data[$id] = $id;
        }
        Yii::app()->session['offers'] = $data;
        echo CJSON::encode([
            'items' => Yii::app()->session['offers'],
            'count' => count(Yii::app()->session['offers']),
        ]);
    }

    public function actionView()
    {
        $products = [];
        $attr = [];
        if (Yii::app()->session['offers']) {
            $products = Product::model()->findAllByPk(Yii::app()->session['offers']);
            foreach ($products as $key => $product) {
                foreach ($product->attributesValues as $key => $value) {
                    if ($elem = $value->attribute()) {
                        $attr[$elem->id] = $elem->attributes;
                    }
                }
            }
        }
        $this->render('view', [
            'products' => $products,
            'attr' => $attr,
        ]);
    }

    public function actionClear()
    {
        Yii::app()->session['offers'] = null;
        $this->redirect('/store');
    }

    public function actionRemove($id)
    {
        $product = Yii::app()->session['offers'];
        if (isset($product[$id])) {
            unset($product[$id]);
        }
        Yii::app()->session['offers'] = $product;

        $products = [];
        if (Yii::app()->session['offers']) {
            $products = Product::model()->findAllByPk(Yii::app()->session['offers']);
            $attr = [];
            foreach ($products as $key => $product) {
                foreach ($product->attributesValues as $key => $value) {
                    if ($elem = $value->attribute()) {
                        $attr[$elem->id] = $elem->attributes;
                    }
                }
            }
        }
        $this->renderPartial('_item', [
            'products' => $products,
            'attr' => $attr,
        ]);

    }
}
