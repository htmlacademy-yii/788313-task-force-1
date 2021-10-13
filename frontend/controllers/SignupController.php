<?php

namespace frontend\controllers;

use Yii;
use frontend\models\City;
use frontend\models\SignupForm;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
                'denyCallback' => fn ($rule, $action) => Yii::$app->response->redirect(['task/index'])
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

    public function actionValidateEmail()
    {
        // validate for ajax request
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $signupForm = new SignupForm();
            $signupForm->load(Yii::$app->request->post());

            return ActiveForm::validate($signupForm);
        }
    }
}
