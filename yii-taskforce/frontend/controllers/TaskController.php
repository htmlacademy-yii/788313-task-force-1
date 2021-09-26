<?php


namespace frontend\controllers;


use Yii;
use frontend\models\Task;
use frontend\models\TaskForm;
use frontend\models\Category;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;


class TaskController extends SecuredController
{

    public function actionIndex($cat = null):string
    {
        $taskForm = new TaskForm;
        $taskForm->load(Yii::$app->request->post());

        $categories = Category::find()
            ->all();

        if ($cat) {
            $category = Category::find()
                ->select('id')
                ->where(['code' => $cat])
                ->one();
        }
        $tasks = Task::find()
            ->where (['idPerformer' => 0])
            ->filterWhere([
                'and',
                ['category_id' => $category ?? $taskForm->getCategoryId()],
                ['>=', 'date_create', $taskForm->getPeriod()],
                ['like', 'title', $taskForm->getSearch()]
            ])
            ->orderBy('date_create DESC')
            ->all();

        return $this->render('index', [
            'tasks' => $tasks,
            'taskForm' => $taskForm,
            'categories' => $categories,
            'cat' => $cat
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {

        $task = Task::find()
            ->where (['id' => $id])
            ->one();

        if (empty($task))
        {
            throw new NotFoundHttpException('Проверьте правильность введенных данных');
        }

        return $this->render('view', [
            'task' => $task
        ]);
    }


}
