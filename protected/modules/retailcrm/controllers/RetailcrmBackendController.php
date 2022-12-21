<?php

/**
 * RetailcrmBackendController
 *
 * @author   monshtrina@yandex.ru
 **/

use yupe\models\Settings;

class RetailcrmBackendController extends yupe\components\controllers\BackController
{
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Retailcrm.TemplateBackend.Index']],
            ['deny']
        ];
    }

    public function actions()
    {
        return [
        ];
    }

    public function actionIndex()
    {
        $model = new Retailcrm;

        $this->render('index', ['model' => $model]);
    }

    public function actionRemove()
    {
        $model = new Retailcrm;

        Settings::saveModuleSettings('retailcrm', [
            'access_token' => '',
            'refresh_token' => '',
            'expires' => '',
            'baseDomain' => '',
        ]);

        $this->render('index', ['model' => $model]);
    }
}
