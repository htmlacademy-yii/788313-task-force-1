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
                'denyCallback' => fn ($rule, $action) => Yii::$app->response->redirect(['task/index'])

            ]
        ];
    }

    public function actionIndex()
    {
        $loginForm = new LoginForm();
        $this->layout = 'login';

        if (Yii::$app->request->getIsPost()) {
            $loginForm->load(Yii::$app->request->post());
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                Yii::$app->user->login($user);
                return Yii::$app->response->redirect(['task']);
            }
        }

        $lastTask = Task::find()
            ->orderBy('date_create DESC')
            ->limit(4)
            ->all();

        Yii::$app->getView()->params['lastTask'] = $lastTask;

        return $this->render('index', [
            'loginForm' => $loginForm
        ]);
    }

    /*public function actionValidateEmail()
    {
        // validate for ajax request
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $loginForm = new LoginForm();
            $loginForm->load(Yii::$app->request->post());

            return ActiveForm::validate($loginForm);
        }
    }*/
}
