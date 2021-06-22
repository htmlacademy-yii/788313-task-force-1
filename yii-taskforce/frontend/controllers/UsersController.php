<?php


namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\User;

class UsersController extends Controller
{
    public array $users;
    public string $sortUser; // Доделать изменение сортировки

    public function actionIndex():string
    {
        $this->sortUser = 'date_reg';

        $users = User::find()
            ->with()
            ->where (['status' => 0])
            ->orderBy($this->sortUser)
            ->all();

        return $this->render('index', [
            'users' => $users
        ]);
    }
}
