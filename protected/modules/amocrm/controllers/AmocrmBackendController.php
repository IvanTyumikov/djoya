<?php

/**
 * AmocrmBackendController
 *
 * @author   monshtrina@yandex.ru
 **/

use yupe\models\Settings;

class AmocrmBackendController extends yupe\components\controllers\BackController
{
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Amocrm.TemplateBackend.Index']],
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
        $model = new Amocrm;

        $this->render('index', ['model' => $model]);
    }

    public function actionRemove()
    {
        $model = new Amocrm;

        Settings::saveModuleSettings('amocrm', [
            'access_token' => '',
            'refresh_token' => '',
            'expires' => '',
            'baseDomain' => '',
        ]);

        $this->render('index', ['model' => $model]);
    }
}
