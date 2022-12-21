<?php

/**
 * DaDataComponent
 */
class DaDataComponent extends CApplicationComponent
{
    public $token       = null;
    public $secret       = null;
    public $cachePrefix = 'dadata_';
    public $cache       = false;
    public $cacheTime   = 86400;

    public function init()
    {
        if ($this->token === null) {
            throw new CException("Необходимо установить токет DaData");
        }
    }

    /**
     * Получить Регион из DaData
     * @return array
     */
    public function getRegion($query)
    {
        $cacheKey = $this->cachePrefix.'region_'.md5($query);
        $result = Yii::app()->cache->get($cacheKey);
        if ($result===false) {
            $dadata = new \Dadata\DadataClient($this->token, $this->secret);
            $result = $dadata->suggest(
                "address",
                $query,
                \Dadata\Settings::SUGGESTION_COUNT,
                [
                    'from_bound'     => ['value' => 'region'],
                    'to_bound'       => ['value' => 'region'],
                ]
            );
            Yii::app()->cache->set($cacheKey, $result, $this->cacheTime);
        }

        return $result;
    }

    /**
     * Получить город из DaData
     * @return array
     */
    public function getCity($query)
    {
        $regionJson = Yii::app()->request->getParam('region');
        $region = [];

        if ($regionJson) {
            $region = CJSON::decode($regionJson);
            $cacheKey = $this->cachePrefix.'city_'.md5($region['id'].$query);
        } else {
            $cacheKey = $this->cachePrefix.'city_'.md5($query);
        }

        $result = Yii::app()->cache->get($cacheKey);
        // $result = false;
        if ($result===false) {
            $getParam = [
                'from_bound' => ['value' => 'city'],
                'to_bound'   => ['value' => 'settlement'],
                'restrict_value' => true,
            ];
            // if (isset($region['region_fias_id'])) {
            //     $getParam['locations']['region_fias_id'] = $region['region_fias_id'];
            // }
            if (isset($region['region'])) {
                $getParam['locations']['region'] = $region['region'];
            }
            $dadata = new \Dadata\DadataClient($this->token, null);
            $result = $dadata->suggest(
                "address",
                $query,
                10, // кол-во выводимых элементов
                $getParam
            );

            Yii::app()->cache->set($cacheKey, $result, $this->cacheTime);
        }

        return $result;
    }

    public function getAddress($query)
    {
        $cacheKey = $this->cachePrefix.'address_'.md5($query);
        $result = Yii::app()->cache->get($cacheKey);
        if ($result===false) {
            $dadata = new \Dadata\DadataClient($this->token, null);
            $result = $dadata->suggest("address", $query, \Dadata\Settings::SUGGESTION_COUNT);

            Yii::app()->cache->set($cacheKey, $result, $this->cacheTime);
        }

        return $result;
    }

    public function iplocate()
    {
        $ip = CHttpRequest::getUserHostAddress();
        $cacheKey = $this->cachePrefix.md5($ip);
        $result = Yii::app()->cache->get($cacheKey);
        if ($result===false) {
            $dadata = new \Dadata\DadataClient($this->token, null);
            $result = $dadata->iplocate($ip);

            Yii::app()->cache->set($cacheKey, $result, $this->cacheTime);
        }

        return $result;
    }

    public function delivery($kladrId = null)
    {
        if ($kladrId===null) {
            throw new Exception("Необходимо передать параметр kladrId");
        }
        $cacheKey = $this->cachePrefix.'delivery_'.$kladrId;

        $result = Yii::app()->cache->get($cacheKey);
        if ($result===false) {
            $dadata = new \Dadata\DadataClient($this->token, null);
            $result = $dadata->findById("delivery", $kladrId, 1);

            Yii::app()->cache->set($cacheKey, $result, $this->cacheTime);
        }

        return $result;
    }

    public function cleatPhone($phone)
    {
        $cacheKey = $this->cachePrefix.md5($phone);
        $result = Yii::app()->cache->get($cacheKey);
        if ($result===false) {
            $dadata = new \Dadata\DadataClient($this->token, $this->secret);
            $result = $dadata->clean('phone', $phone);

            Yii::app()->cache->set($cacheKey, $result, $this->cacheTime);
        }

        return $result;
    }
}
