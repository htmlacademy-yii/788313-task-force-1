<?php

namespace frontend\controllers;

use Yii;
use frontend\models\City;
use frontend\models\SignupForm;
use yii\base\Exception;
use yii\web\Controller;

class SignupController extends Controller
{

    /**
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $signupForm = new SignupForm();

        if ($signupForm->load(Yii::$app->request->post()) && $signupForm->validate()) {
            $signupForm->signup();
            $this->goHome();
        }

        $city = City::find()
            ->select(  'name')
            ->column();

        return $this->render('index', [
            'city' => $city,
            'signupForm' => $signupForm
        ]);
    }
}
