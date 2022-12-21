<?php

use yupe\components\controllers\FrontController;

/**
 * DeliveryController
 */
class DeliveryAjaxController extends FrontController
{
    public function actionDeliveryList()
    {
        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap = [
                // В карте отключаем загрузку core-скриптов, УЖЕ подключенных до ajax загрузки
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.ui.js' => false,
                'jquery.ui.min.js' => false,
                // На моей странице была ещё одна форма, поэтому jquery.yiiactiveform.js я исключил
                'jquery.yiiactiveform.js' => false,
                'jquery.yiiactiveform.min.js' => false,
            ];
        }

        $order = new Order;
        if (isset($_POST['Order'])) {
            $order->setAttributes($_POST['Order']);
        }

        $this->widget('application.modules.delivery.widgets.DeliveryWidget', ['order' => $order]);
    }

    public function actionDeliveryMethod()
    {
        $this->widget('application.modules.delivery.widgets.DeliveryMethodWidget');
    }
}
