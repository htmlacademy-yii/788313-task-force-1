<?php


namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use yii\base\BaseObject;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\TasksForm;

class UsersController extends Controller
{
    public array $users;
    public string $sortUser; // Доделать изменение сортировки

    public function actionIndex():string
    {
        $this->sortUser = 'date_reg';

        $usersForm = new TasksForm;
        $usersForm->load(Yii::$app->request->post());

        $users = User::find()
            ->joinWith(['categories'])
            ->where (['status' => 0])
            ->filterWhere([
                'and',
                ['category.id' => $usersForm['category_ids']],
                ['like', 'user.name', $usersForm['search']]
            ])
            ->orderBy($this->sortUser)
            ->all();

        $categories = Category::find()
            ->all();

        return $this->render('index', [
            'users' => $users,
            'usersForm' => $usersForm,
            'categories' => $categories
        ]);
    }


}
