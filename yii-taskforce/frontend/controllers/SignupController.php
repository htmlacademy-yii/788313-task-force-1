<?php

namespace frontend\controllers;

use Yii;
use frontend\models\City;
use frontend\models\SignupForm;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class SignupController extends Controller
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

    /**
     * @throws Exception
     */
    public function actionIndex()
    {
        $signupForm = new SignupForm();

        if ($signupForm->load(Yii::$app->request->post()) && $signupForm->validate()) {
            $signupForm->signup();
            return $this->goHome();
        }

        $city = City::find()
            ->select('name')
            ->column();

        return $this->render('index', [
            'city' => $city,
            'signupForm' => $signupForm
        ]);
    }
}
