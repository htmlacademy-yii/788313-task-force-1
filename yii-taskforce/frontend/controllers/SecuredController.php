<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SecuredController extends Controller
{
    public function behaviors():array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['login/index']);
                }
            ]
        ];
    }
}
