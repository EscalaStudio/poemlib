<?php
namespace console\controllers;

use backend\models\BackendUser;
use yii\base\ErrorException;

class NewAdminController extends \yii\console\Controller
{

    public function actionNewadmin()
    {
        $model = new BackendUser();
        $model->username = 'admin';
        $model->email = 'admin@admin.admin';
        $model->setPassword('admin');
        $model->generateAuthKey();
        $model->status = 10;
        if ($model->save())
            echo 'Админ успешно создан';
    }
}