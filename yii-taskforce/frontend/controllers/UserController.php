<?php


namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use yii\base\BaseObject;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\TaskForm;

class UserController extends Controller
{
    public array $users;
    public string $sortUser; // Доделать изменение сортировки

    public function actionIndex():string
    {
        $this->sortUser = 'date_reg';

        $userForm = new TaskForm;
        $userForm->load(Yii::$app->request->post());

        $users = User::find()
            ->joinWith(['category'])
            ->where (['status' => 0])
            ->filterWhere([
                'and',
                ['category.id' => $userForm->getCategoryId()],
                ['like', 'user.name', $userForm->getSearch()]
            ])
            ->orderBy($this->sortUser)
            ->all();

        $categories = Category::find()
            ->all();

        return $this->render('index', [
            'users' => $users,
            'userForm' => $userForm,
            'categories' => $categories
        ]);
    }


}
