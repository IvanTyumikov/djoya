<?php

use RetailCrm\ApiClient;
use RetailCrm\Exception\CurlException;
use yupe\models\Settings;

	class Retailcrm
	{
        /**
         * @var
         */
        protected $order;

		/** 
		 * Client
		 *
		 * @return object
		 */
		public function getApiClient()
		{
            $module = Yii::app()->getModule('retailcrm');

            return new ApiClient(
                $module->base_domain,
                $module->api_key,
                ApiClient::V5
            );
		}

		/* Add order */
		public function addOrder($products, $attributes, $id)
        {
            $items = [];
            foreach ($products as $product) {
                $items[] = [
                    'id' => $product->id,
                    'quantity' => $product->quantity,
                    'initialPrice' => $product->price,
                    'productName' => $product->product_name,
                ];
            }
            
            $data = [
                'number' => $id,
                'firstName' => $attributes['name'],
                'phone' => $attributes['phone'],
                'email' => $attributes['email'],
                'items' => $items,
                'delivery' => [
                    'code' => 'fedex',
                ]
            ];

            try {
                $response = $this->getApiClient()->request->ordersCreate($data);
            } catch (CurlException $e) {

//              echo "Connection error: " . $e->getMessage();
                return false;
            }

//            foreach ($this->getClients() as $client) {
//                $this->addContact($client);
//            }

            if ($response->isSuccessful() && 201 === $response->getStatusCode()) {
                return true;
            } else {
                echo sprintf(
                    "Error: [HTTP-code %s] %s",
                    $response->getStatusCode(),
                    $response->getErrorMsg()
                );
                return false;
            }
        }

        /* Add contact */
        public function addContact($data)
        {
            $phones = [
                [
                    'number' => $data['phone']
                ]
            ];
            
            if(isset($data['phone2'])){
                $phones[] = [
                    'number' => $data['phone2']
                ];
            }

            if(isset($data['phone3'])){
                $phones[] = [
                    'number' => $data['phone3']
                ];
            }

            $array = [
                'firstName' => $data['name'],
                'email' => isset($data['email']) ? $data['email'] : '',
                'phones' => $phones
            ];

            try {
                $response = $this->getApiClient()->request->customersCreate($array);
            } catch (CurlException $e) {
                echo "<pre>";
                print_r($e);
                Yii::app()->end();
//              echo "Connection error: " . $e->getMessage();
            }
        }

        public function getClients()
        {
            return [

            ];
        }
	}
 ?>

