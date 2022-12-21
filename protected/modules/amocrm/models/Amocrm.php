<?php
    use League\OAuth2\Client\Token\AccessToken;
    use League\OAuth2\Client\Token\AccessTokenInterface;

    use AmoCRM\Client\AmoCRMApiClient;
    use AmoCRM\Collections\ContactsCollection;
	use AmoCRM\Collections\CustomFieldsValuesCollection;
	use AmoCRM\Collections\Leads\LeadsCollection;
	use AmoCRM\Exceptions\AmoCRMApiException;
    use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
    use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
    use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
    use AmoCRM\Models\LeadModel;
    use AmoCRM\Models\CompanyModel;
    use AmoCRM\Models\ContactModel;
    use AmoCRM\Collections\TagsCollection;
    use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
    use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
    use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
    use AmoCRM\Models\TagModel;
    use AmoCRM\Collections\LinksCollection;
    use AmoCRM\Collections\NullTagsCollection;
    use AmoCRM\Filters\LeadsFilter;
    use AmoCRM\Models\CustomFieldsValues\ValueCollections\NullCustomFieldValueCollection;

    use AmoCRM\Helpers\EntityTypesInterface;


    use yupe\models\Settings;

	class Amocrm
	{
		/** 
		 * Авторизация 
		 *
		 * @return object
		 */
		public function getApiClient()
		{
			$module = Yii::app()->getModule('amocrm');
			$apiClient = new AmoCRMApiClient(
				$module->clientId, 
				$module->clientSecret, 
				$module->redirectUri
			);

			$url = $_SERVER['REQUEST_URI'];
			$url = explode('?', $url);
			$url = $url[0];

			if($this->getToken() === false && $url === Yii::app()->createUrl('/amocrm/amocrmBackend/index'))
			{
				session_start();

	            if (isset($_GET['referer'])) {
	                $apiClient->setAccountBaseDomain($_GET['referer']);
	            }

	            if (!isset($_GET['code'])) {
	                $state = bin2hex(random_bytes(16));
	                $_SESSION['oauth2state'] = $state;
	                
	                $authorizationUrl = $apiClient->getOAuthClient()->getAuthorizeUrl([
	                    'state' => $state,
	                    'mode' => 'post_message',
	                ]);
	                header('Location: ' . $authorizationUrl);
	                die;
	            } elseif (empty($_GET['state']) || empty($_SESSION['oauth2state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
	                unset($_SESSION['oauth2state']);
	                exit(Yii::t('AmocrmModule.amocrm', 'Invalid access token '));
	            }

	            try {
	                $accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode($_GET['code']);

	                if (!$accessToken->hasExpired()) {
	                    $this->saveToken([
	                        'accessToken' => $accessToken->getToken(),
	                        'refreshToken' => $accessToken->getRefreshToken(),
	                        'expires' => $accessToken->getExpires(),
	                        'baseDomain' => $apiClient->getAccountBaseDomain(),
	                    ]);
	                }
	            } catch (Exception $e) {
	                die((string)$e);
	            }
			} else {
				$accessToken = $this->getToken();

	            $apiClient->setAccessToken($accessToken)
	            ->setAccountBaseDomain($accessToken->getValues()['baseDomain'])
	            ->onAccessTokenRefresh(
	                function (AccessTokenInterface $accessToken, string $baseDomain) {
	                    $this->saveToken([
                            'accessToken' => $accessToken->getToken(),
                            'refreshToken' => $accessToken->getRefreshToken(),
                            'expires' => $accessToken->getExpires(),
                            'baseDomain' => $baseDomain,
                        ]);
	                }
	            );

				$refreshToken = $apiClient->getOAuthClient()->getAccessTokenByRefreshToken($accessToken);

				// echo '<pre>';
				// print_r($accessToken);
				// echo '<br>';
				// print_r($refreshToken);
				$this->saveToken([
					'accessToken' => $refreshToken->getToken(),
					'refreshToken' => $refreshToken->getRefreshToken(),
					'expires' => $refreshToken->getExpires(),
					'baseDomain' => $accessToken->getValues()['baseDomain'],
				]);

	            return $apiClient;
			}

            return false;
		}

		/**
		 * Статус интеграции для отображения в админке 
		 *
		 * @return string
		 */
		public function getApiClientStatus()
		{
			if(!$this->getApiClient()){
				return Yii::t('AmocrmModule.amocrm', 'An error occurred while integrating');
			}

			return Yii::t('AmocrmModule.amocrm', 'Successful integration');
		}

		/* Сохраняю токены в базу данных */
		private function saveToken(array $accessToken)
		{
			if (
	            isset($accessToken)
	            && isset($accessToken['accessToken'])
	            && isset($accessToken['refreshToken'])
	            && isset($accessToken['expires'])
	            && isset($accessToken['baseDomain'])
	        ) {
	        	Settings::saveModuleSettings('amocrm', [
	        		'access_token' => $accessToken['accessToken'],
	        		'refresh_token' => $accessToken['refreshToken'],
	        		'expires' => $accessToken['expires'],
	        		'baseDomain' => $accessToken['baseDomain'],
	        	]);
	        } else {
	            exit(Yii::t('AmocrmModule.amocrm', 'Invalid access token ') . var_export($accessToken, true));
	        }
		}

		/** 
		 * Возвращаем объект с токенами 
		 *
		 * @return object
		 */
		private function getToken()
	    {
	    	$module = Yii::app()->getModule('amocrm');

	    	$data = [
	    		'access_token' => $module->access_token,
	    		'refresh_token' => $module->refresh_token,
	    		'expires' => $module->expires,
	    		'baseDomain' => $module->baseDomain,
	    	];

	        if (
	            !empty($data['access_token'])
	            && !empty($data['refresh_token'])
	            && !empty($data['expires'])
	            && !empty($data['baseDomain'])
	        ) {
	            return new AccessToken($data);
	        } else {
	            return false;
	        }
	    }

	    /* Добавление лида */
		public function addLead(array $data)
		{
			if(!$this->getApiClient()){
				return false;
			}

//            try {
//				$leadsService = $this->getApiClient()->leads();
//
//				$lead = new LeadModel();
//
//				$leadCustomFieldsValues = new CustomFieldsValuesCollection();
//
//		        $textCustomFieldValueModel = new TextCustomFieldValuesModel();
//		        $textCustomFieldValueModel->setFieldId(86271);
//		        $textCustomFieldValueModel->setValues(
//		            (new TextCustomFieldValueCollection())
//		                ->add((new TextCustomFieldValueModel())->setValue($data['phone']))
//		        );
//
//		        $textCustomFieldValueModel2 = new TextCustomFieldValuesModel();
//		        $textCustomFieldValueModel2->setFieldId(126251);
//		        $textCustomFieldValueModel2->setValues(
//		            (new TextCustomFieldValueCollection())
//		                ->add((new TextCustomFieldValueModel())->setValue(Yii::app()->controller->utm['utm_term']))
//		        );
//
//		        $textCustomFieldValueModel3 = new TextCustomFieldValuesModel();
//		        $textCustomFieldValueModel3->setFieldId(126253);
//		        $textCustomFieldValueModel3->setValues(
//		            (new TextCustomFieldValueCollection())
//		                ->add((new TextCustomFieldValueModel())->setValue(Yii::app()->controller->utm['utm_content']))
//		        );
//
//		        $textCustomFieldValueModel4 = new TextCustomFieldValuesModel();
//		        $textCustomFieldValueModel4->setFieldId(126255);
//		        $textCustomFieldValueModel4->setValues(
//		            (new TextCustomFieldValueCollection())
//		                ->add((new TextCustomFieldValueModel())->setValue(Yii::app()->controller->utm['utm_source']))
//		        );
//
//		        $textCustomFieldValueModel5 = new TextCustomFieldValuesModel();
//		        $textCustomFieldValueModel5->setFieldId(126257);
//		        $textCustomFieldValueModel5->setValues(
//		            (new TextCustomFieldValueCollection())
//		                ->add((new TextCustomFieldValueModel())->setValue(Yii::app()->controller->utm['utm_medium']))
//		        );
//
//		        $textCustomFieldValueModel5 = new TextCustomFieldValuesModel();
//		        $textCustomFieldValueModel5->setFieldId(155505);
//		        $textCustomFieldValueModel5->setValues(
//		            (new TextCustomFieldValueCollection())
//		                ->add((new TextCustomFieldValueModel())->setValue(Yii::app()->controller->utm['utm_campaign']))
//		        );
//
//		        $leadCustomFieldsValues->add($textCustomFieldValueModel);
//		        $leadCustomFieldsValues->add($textCustomFieldValueModel2);
//		        $leadCustomFieldsValues->add($textCustomFieldValueModel3);
//		        $leadCustomFieldsValues->add($textCustomFieldValueModel4);
//		        $leadCustomFieldsValues->add($textCustomFieldValueModel5);
//
//		        $lead->setCustomFieldsValues($leadCustomFieldsValues);
//		        $lead->setName($data['name']);
//
//		        $leadsCollection = new LeadsCollection();
//		        $leadsCollection->add($lead);
//                $lead = $leadsService->addOne($lead);
//
//                return true;
//            } catch (AmoCRMApiException $e) {
//                // echo "<pre>";
//                // print_r($e);
//                // die;
//                return false;
//            }

            $leadsCollection = new LeadsCollection();

            $lead = (new LeadModel())
                ->setName($data['name'])
                ->setPipelineId(4333054)
                ->setCustomFieldsValues(
                    (new CustomFieldsValuesCollection())
                        ->add(
                            (new TextCustomFieldValuesModel())
                                ->setFieldId(126255)
                                ->setValues(
                                    (new TextCustomFieldValueCollection())
                                        ->add((new TextCustomFieldValueModel())->setValue($data['utm_source']))
                                )
                        )
                        ->add(
                            (new TextCustomFieldValuesModel())
                                ->setFieldId(126257)
                                ->setValues(
                                    (new TextCustomFieldValueCollection())
                                        ->add((new TextCustomFieldValueModel())->setValue($data['utm_medium']))
                                )
                        )
                        ->add(
                            (new TextCustomFieldValuesModel())
                                ->setFieldId(155505)
                                ->setValues(
                                    (new TextCustomFieldValueCollection())
                                        ->add((new TextCustomFieldValueModel())->setValue($data['utm_campaign']))
                                )
                        )
                        ->add(
                            (new TextCustomFieldValuesModel())
                                ->setFieldId(126253)
                                ->setValues(
                                    (new TextCustomFieldValueCollection())
                                        ->add((new TextCustomFieldValueModel())->setValue($data['utm_content']))
                                )
                        )
                        ->add(
                            (new TextCustomFieldValuesModel())
                                ->setFieldId(126251)
                                ->setValues(
                                    (new TextCustomFieldValueCollection())
                                        ->add((new TextCustomFieldValueModel())->setValue($data['utm_term']))
                                )
                        )
                )
                ->setTags(
                    (new TagsCollection())
                        ->add(
                            (new TagModel())
                                ->setName('Заявка с Facebook')
                        )
                )
                ->setContacts(
                    (new ContactsCollection())
                        ->add(
                            (new ContactModel())
                                ->setFirstName($data['name'])
                                ->setCustomFieldsValues(
                                    (new CustomFieldsValuesCollection())
                                        ->add(
                                            (new MultitextCustomFieldValuesModel())
                                                ->setFieldCode('PHONE')
                                                ->setValues(
                                                    (new MultitextCustomFieldValueCollection())
                                                        ->add(
                                                            (new MultitextCustomFieldValueModel())
                                                                ->setValue($data['phone'])
                                                        )
                                                )
                                        )
                                )
                        )
                );

            $leadsCollection->add($lead);
            
//            echo "<pre>";
//            print_r($this->getApiClient()->leads()->addComplex($leadsCollection));
//            Yii::app()->end();
            
            //Создаю сделки
            try {
                $addedLeadsCollection = $this->getApiClient()->leads()->addComplex($leadsCollection);
            } catch (AmoCRMApiException $e) {
                printError($e);
                die;
            }
		}
	}
 ?>