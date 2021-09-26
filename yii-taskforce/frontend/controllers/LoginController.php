<?php

namespace frontend\controllers;

use frontend\models\LoginForm;
use frontend\models\Task;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class LoginController extends Controller
{
    public function behaviors():array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['task/index']);
                }
            ]
        ];
    }

    public function actionIndex()
    {
        $loginForm = new LoginForm();

        if (Yii::$app->request->getIsPost()) {
            $loginForm->load(Yii::$app->request->post());
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                Yii::$app->user->login($user);
                return Yii::$app->response->redirect(['task']);
            }
        }
        $this->layout = 'login';

        $lastTask = Task::find()
            ->orderBy('date_create DESC')
            ->limit(4)
            ->all();

        Yii::$app->getView()->params['lastTask'] = $lastTask;

        return $this->render('index', [
            'loginForm' => $loginForm
        ]);
    }
}
