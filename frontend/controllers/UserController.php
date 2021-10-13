<?php


namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use frontend\models\User;
use frontend\models\TaskForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UserController extends SecuredController
{
    public string $sortUser; // Доделать изменение сортировки

    public function actionIndex():string
    {
        $this->sortUser = 'date_reg';

        $userForm = new TaskForm;
        $userForm->load(Yii::$app->request->post());

        $users = User::find()
            ->joinWith('categories', true,'INNER JOIN')
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

    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        $user = User::find()
            ->where (['id' => $id])
            ->one();

        if (empty($user))
        {
            throw new NotFoundHttpException('Такого пользователя не существует');
        }

        return $this->render('view', [
            'user' => $user
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


}
