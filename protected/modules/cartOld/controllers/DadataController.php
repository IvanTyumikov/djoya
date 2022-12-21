<?php

/**
 * DadataController
 */
class DadataController extends yupe\components\controllers\FrontController
{
    public function actionGetCity($query = null)
    {
        if ($query===null) {
            throw new CException("Необходимо задать строку запроса");
        }

        // $city = [];
        // $city[] = Yii::app()->dadata->iplocate();

        $city = Yii::app()->dadata->getCity($query);

        $data = array_map(function ($e) {
            return array_merge($e['data'], [
                'text' => $e['value'],
                'id'   => $e['data']['kladr_id'],
            ]);
        }, $city);

        echo CJSON::encode(['results' => $data]);
    }

    public function actionGetRegion($query = null)
    {
        if ($query===null) {
            throw new CException("Необходимо задать строку запроса");
        }

        $region = Yii::app()->dadata->getRegion($query);

        $data = array_map(function ($e) {
            return array_merge($e['data'], [
                'text' => $e['value'],
                'id'   => $e['data']['kladr_id'],
            ]);
        }, $region);

        echo CJSON::encode(['results' => $data]);
    }

    public function actionGetAddress($query = null)
    {
        if ($query===null) {
            throw new CException("Необходимо задать строку запроса");
        }

        $address = Yii::app()->dadata->getAddress($query);

        $data = array_map(function ($e) {
            return [
                'text'               => $e['value'],
                'id'                 => $e['data']['kladr_id'],
                'unrestricted_value' => $e['unrestricted_value'],
                'data'               => $e['data'],
            ];
        }, $address);

        echo CJSON::encode(['results' => $data]);
    }
}
